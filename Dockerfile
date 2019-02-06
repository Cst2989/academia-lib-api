FROM php:5.6-apache

RUN docker-php-ext-install pdo_mysql
RUN a2enmod rewrite

ADD . /var/www
ADD ./public /var/www/html

RUN chown -R www-data:www-data /var/www

RUN chmod -R 755 /var/www/storage
