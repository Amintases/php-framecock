FROM php:8.1-fpm

RUN apt-get update \
     && apt-get install -y libzip-dev \
     unzip \
     && docker-php-ext-install zip \
     && docker-php-ext-install mysqli

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY conf.d/ $PHP_INI_DIR/conf.d/

