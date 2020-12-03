FROM php:7.4-fpm-alpine AS symfony_php

RUN apk --no-cache add postgresql-dev
RUN docker-php-ext-install -j$(nproc) pdo pdo_pgsql && docker-php-ext-enable pdo_pgsql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER=1
ENV PATH="${PATH}:/root/.composer/vendor/bin"

WORKDIR /var/www/html/okommerce

COPY . .

RUN set -eux; \
    mkdir -p var/cache var/log; \
    composer install --prefer-dist --no-progress --no-interaction; \
    composer clear-cache; \
    composer dump-autoload --classmap-authoritative --no-dev; \
    composer symfony:dump-env prod; \
    composer run-script post-install-cmd; sync

RUN chown -R 1000:1000 .
USER 1000:1000