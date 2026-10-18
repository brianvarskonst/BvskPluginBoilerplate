---
name: verify-plugin
description: Checks this Shopware plugin in a throwaway Shopware 6.7 (Docker) and removes everything afterwards. Use before handing over any change to the plugin, when a task asks to test, verify or prove that the plugin works, or when no Shopware installation is at hand.
---

# Verify the plugin

Needs Docker. Do not test against a real shop or its database.

```bash
bash .agents/skills/verify-plugin/scripts/throwaway-shopware.sh
```

`PHP_IMAGE=php:8.2-cli-alpine` (or `8.3`, `8.5`) selects the PHP version, the default is 8.4.
The run takes about ten minutes. `.github/workflows/ci.yml` runs the same script for PHP 8.2 and 8.5.

## What the script does

1. Starts MariaDB and PHP in their own Docker network, installs the PHP extensions and Composer.
2. `composer validate` for the plugin.
3. Creates `shopware/production` (latest 6.7), installs the shop and the plugin.
4. `dal:validate` must not list a definition of the plugin.
5. Uninstalls the plugin without "keep user data": the table list of the shop has to be the same as before the install. Then installs it again.
6. `bash bin/phpstan.sh` and `bash bin/phpunit.sh` inside the shop.
7. Removes containers, network, volumes and every image that it had to pull. Images that were there before stay.

The last line is `== VERIFY OK`. Any other end is a failure, the output above it names the step.

## When the script is not enough

- The script covers install, lifecycle, entities and tests. It does not click through the Storefront or call the routes. For a change to a controller, route or template run the shop yourself from the same recipe (`composer create-project shopware/production`, `bin/console system:install --basic-setup`, `php -S 0.0.0.0:8000 -t public public/index.php`) and call the route, with and without login.
- Remove what you started. Report what you ran, what you did not run and the risk that is left.
