FROM php:7.1.3-fpm

COPY . /var/www

WORKDIR /var/www

RUN apt-get update && \
    apt-get install --yes zip unzip php-pclzip && \
    apt-get install -y --no-install-recommends git zip

RUN curl --silent --show-error https://getcomposer.org/installer | php \
    && php composer.phar install --no-dev --no-scripts

RUN chown -R www-data:www-data \
        /var/www/storage \
        /var/www/bootstrap/cache

RUN php artisan optimize
