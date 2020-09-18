FROM php:7.3-rc-fpm

RUN apt-get update \
    && apt-get install -y git zip unzip --no-install-recommends libpng-dev libjpeg-dev \
    && docker-php-ext-configure gd --with-png-dir=/usr/include --with-jpeg-dir=/usr/include \
    && docker-php-ext-install pdo_mysql gd exif \
    && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

ADD uploads.ini /usr/local/etc/php/conf.d/uploads.ini
