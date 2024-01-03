FROM php:8.1-fpm

MAINTAINER Everton Sena <evertonsena2009@gmail.com>

# Install system dependencies
RUN apt-get update && \
    apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

RUN curl -sS https://getcomposer.org/installer | php ;mv composer.phar /usr/local/bin/composer;

# php.ini of production
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

WORKDIR /var/www/html
