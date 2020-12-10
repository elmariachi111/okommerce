FROM php:7.4-fpm-alpine AS symfony_php

RUN apk --no-cache --update add postgresql-dev \
    && docker-php-ext-install -j$(nproc) pdo pdo_pgsql \
    && docker-php-ext-enable pdo_pgsql \
    && rm -rf /var/cache/apk/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER=1
ENV PATH="${PATH}:/root/.composer/vendor/bin"
ARG APP_ENV="dev"

WORKDIR /var/www/html/zett

COPY ./composer.* ./

RUN set -eux; \
    mkdir -p var/cache var/log; \
    composer install --prefer-dist --no-progress --no-dev --no-interaction; 

COPY . .
RUN composer clear-cache; \
    composer dump-autoload --classmap-authoritative --no-dev; \
    composer symfony:dump-env prod; \
    composer run-script post-install-cmd; sync

RUN chown -R 1000:1000 .
USER 1000:1000