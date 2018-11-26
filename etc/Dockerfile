FROM php:7.2-fpm

VOLUME /var/www/html
RUN apt-get update && apt-get install -y libz-dev libmemcached-dev libjpeg-dev libpng-dev \
    && pecl install memcached \
    && docker-php-ext-enable memcached \
    && docker-php-ext-install -j$(nproc) pdo pdo_mysql mysqli gd \
    && docker-php-ext-enable pdo pdo_mysql mysqli gd

