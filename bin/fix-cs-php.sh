#!/usr/bin/env bash

echo "Fix php files"

./vendor/shopware/platform/bin/php-cs-fixer.phar fix --config=./vendor/shopware/platform/.php_cs.dist -vv .