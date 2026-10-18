#!/usr/bin/env bash

echo "Fix PHP files"
./../../../vendor/bin/php-cs-fixer fix --config=../../../.php-cs-fixer.dist.php -vv .

echo "Fix Javascript files"
if [ -d src/Resources/app/administration ]; then
    # Shopware's extension tooling only knows installed and active plugins
    cd ../../.. || exit 1
    bin/console bundle:dump
    composer admin:setup-extension-tooling
    composer admin:generate-entity-schema-types
    composer admin:check-extensions -- --only=BvskPluginBoilerplate --fix
else
    echo "No Administration sources found, skipping"
fi
