#!/usr/bin/env bash

composer dump-autoload
./../../../vendor/bin/phpstan analyze --level 7 --configuration phpstan.neon --autoload-file=../../../vendor/autoload.php src tests
