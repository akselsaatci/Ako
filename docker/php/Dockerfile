FROM php:8.4-fpm-alpine

WORKDIR /app

COPY ./docker/php/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf

COPY . .

VOLUME ["/app"]

