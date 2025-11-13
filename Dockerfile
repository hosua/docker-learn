FROM composer:lts as deps
RUN --mount=type=bind,source=composer.json,target=composer.json \
    --mount=type=cache,target=/tmp/cache \
    composer install --no-dev --no-interaction

FROM php:8.2-apache as final
WORKDIR /var/www/html
RUN apt-get update && apt-get install -y libpq-dev && \
    docker-php-ext-install pdo pdo_pgsql pgsql && \
    apt-get clean && rm -rf /var/lib/apt/lists/*
USER www-data
