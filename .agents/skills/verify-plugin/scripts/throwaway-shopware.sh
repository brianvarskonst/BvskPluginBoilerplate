#!/usr/bin/env bash
# Builds a throwaway Shopware 6.7 in Docker, checks this plugin in it and removes everything again.
#
#   bash .agents/skills/verify-plugin/scripts/throwaway-shopware.sh
#
# PHP_IMAGE selects the PHP version, default php:8.4-cli-alpine (supported: 8.2 to 8.5).
set -euo pipefail

PLUGIN_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/../../../.." && pwd)"
PHP_IMAGE="${PHP_IMAGE:-php:8.4-cli-alpine}"
DB_IMAGE="mariadb:11.8"
COMPOSER_IMAGE="composer:2"
ID="sw-verify-$$"
NETWORK="$ID"
DB="$ID-db"
APP="$ID-app"

# Remove only what this run created, images which were already there stay
PULLED=""
for image in "$PHP_IMAGE" "$DB_IMAGE" "$COMPOSER_IMAGE"; do
    [ -z "$(docker images -q "$image")" ] && PULLED="$PULLED $image"
done

cleanup() {
    docker rm -f -v "$APP" "$DB" >/dev/null 2>&1 || true
    docker network rm "$NETWORK" >/dev/null 2>&1 || true
    for image in $PULLED; do
        docker rmi "$image" >/dev/null 2>&1 || true
    done
}
trap cleanup EXIT

echo "== Start database and PHP ($PHP_IMAGE)"
docker network create "$NETWORK" >/dev/null
docker run --quiet -d --name "$DB" --network "$NETWORK" --network-alias db --tmpfs /var/lib/mysql:rw,size=2g \
    -e MARIADB_ROOT_PASSWORD=root -e MARIADB_DATABASE=shopware "$DB_IMAGE" >/dev/null
docker run --quiet -d --name "$APP" --network "$NETWORK" -w /var/www "$PHP_IMAGE" sleep infinity >/dev/null
docker run --quiet --rm --entrypoint cat "$COMPOSER_IMAGE" /usr/bin/composer \
    | docker exec -i "$APP" sh -c 'cat > /usr/local/bin/composer && chmod +x /usr/local/bin/composer'
docker exec "$APP" mkdir -p /tmp/plugin
tar -C "$PLUGIN_DIR" --exclude=.git --exclude=vendor --exclude=var --exclude=coverage -cf - . \
    | docker exec -i "$APP" tar -x -C /tmp/plugin

docker exec -i "$APP" sh -s <<'EOS'
set -eu -o pipefail
export COMPOSER_ALLOW_SUPERUSER=1 COMPOSER_NO_INTERACTION=1
export APP_URL=http://localhost:8000 SHOPWARE_SKIP_WEBINSTALLER=1
export DATABASE_URL=mysql://root:root@db:3306/shopware

step() { echo "== $*"; }
quiet() {
    log=$(mktemp)
    "$@" >"$log" 2>&1 || { tail -40 "$log"; return 1; }
}
tables() {
    php -r '$p = new PDO("mysql:host=db;dbname=shopware", "root", "root"); echo implode("\n", $p->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN)), "\n";'
}

step "PHP extensions"
quiet apk add --no-cache icu-libs icu-data-full libzip libpng libjpeg-turbo freetype libwebp git unzip
quiet apk add --no-cache --virtual .build $PHPIZE_DEPS icu-dev libzip-dev libpng-dev libjpeg-turbo-dev freetype-dev libwebp-dev linux-headers
quiet docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp
quiet docker-php-ext-install -j"$(nproc)" pdo_mysql intl gd zip bcmath
quiet apk del .build
echo "memory_limit=-1" > /usr/local/etc/php/conf.d/shopware.ini

PLUGIN=$(php -r '$c = json_decode(file_get_contents("/tmp/plugin/composer.json"), true)["extra"]["shopware-plugin-class"]; echo substr($c, strrpos($c, "\\") + 1);')
NAMESPACE=$(php -r '$c = json_decode(file_get_contents("/tmp/plugin/composer.json"), true)["extra"]["shopware-plugin-class"]; echo substr($c, 0, strrpos($c, "\\"));')
echo "Plugin $PLUGIN ($NAMESPACE)"

step "composer validate"
composer validate --working-dir=/tmp/plugin

step "Shopware"
quiet composer create-project shopware/production /var/www/shop --no-progress
cp -R /tmp/plugin "/var/www/shop/custom/plugins/$PLUGIN"
cd /var/www/shop
composer show shopware/core | grep -E '^versions'
quiet bin/console system:install --basic-setup --create-database --drop-database --force

step "Install plugin"
tables > /tmp/tables.before
quiet bin/console plugin:refresh
bin/console plugin:install --activate "$PLUGIN" | grep -E 'OK|ERROR'
quiet bin/console cache:clear

step "dal:validate must not list a definition of the plugin"
# dal:validate also exits 1 for the plain tables of the plugin, so only its output counts
validation=$(bin/console dal:validate || true)
if echo "$validation" | grep -F "$NAMESPACE\\"; then
    echo "dal:validate reports the plugin" >&2
    exit 1
fi

step "Uninstall leaves the shop as it was, reinstall works"
bin/console plugin:uninstall "$PLUGIN" | grep -E 'OK|ERROR'
tables > /tmp/tables.after
diff /tmp/tables.before /tmp/tables.after
bin/console plugin:install --activate "$PLUGIN" | grep -E 'OK|ERROR'

step "PHPStan"
quiet composer require --dev --no-progress 'phpunit/phpunit:^11.5' 'phpstan/phpstan:^2'
cd "custom/plugins/$PLUGIN"
sh bin/phpstan.sh | tail -3

step "PHPUnit"
sh bin/phpunit.sh | tail -4
EOS

echo "== VERIFY OK"
