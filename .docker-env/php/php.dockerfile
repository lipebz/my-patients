FROM php:8.3.1-fpm-alpine

ADD ./default.conf /usr/local/etc/php-fpm.d/www.conf


RUN addgroup -g 1000 laravel && adduser -G laravel -g laravel -s /bin/sh -D laravel

RUN mkdir -p /var/www/html

ADD ../../ /var/www/html

RUN docker-php-ext-install pdo

RUN chown -R laravel:laravel /var/www/html