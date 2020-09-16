FROM php:7.3-rc-fpm

RUN apt-get update \
    && apt-get install -y git zip unzip --no-install-recommends \
    && docker-php-ext-install pdo_mysql \
    && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"