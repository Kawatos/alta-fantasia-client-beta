FROM php:8.2-apache
# Instala a extensão PDO MySQL
RUN docker-php-ext-install pdo pdo_mysql