#!/usr/bin/env bash

echo "Fix PHP files"
./../../../vendor/bin/php-cs-fixer fix --config=../../../.php-cs-fixer.dist.php -vv .

echo "Fix Javascript files"
../../../src/Administration/Resources/app/administration/node_modules/.bin/eslint --config ../../../src/Administration/Resources/app/administration/eslint.config.ts --ignore-pattern 'src/Resources/app/storefront/dist/**' --ignore-pattern 'src/Resources/public/**' --ignore-pattern 'coverage/**' --fix .
