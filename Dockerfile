FROM composer:lts as deps
RUN --mount=type=bind,source=composer.json,target=composer.json \
    --mount=type=cache,target=/tmp/cache \
    composer install --no-dev --no-interaction

FROM php:8.2-apache as final
WORKDIR /var/www/html
RUN docker-php-ext-install pdo pdo_mysql
USER www-data
