#!/bin/bash

 docker run \
    -v $(pwd):/data \
    -w /data \
    -i -t composer \
    composer install --prefer-dist

 docker run --rm \
    -v $(pwd):/app \
    -w /app \
    -it php:8.0-cli \
    ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests