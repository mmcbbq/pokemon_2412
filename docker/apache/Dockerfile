FROM php:8.3-apache

RUN    docker-php-ext-install  pdo pdo_mysql
COPY pokemon.conf /etc/apache2/sites-available
RUN a2ensite pokemon.conf
RUN a2enmod rewrite

