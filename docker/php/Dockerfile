FROM php:8.4-fpm-alpine

WORKDIR /app

COPY ./docker/php/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf

COPY ./docker/php/php.ini /usr/local/etc/php/php.ini

COPY . .

VOLUME ["/app"]

