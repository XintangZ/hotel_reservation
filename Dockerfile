FROM composer:latest
COPY . /usr/src/montel/
WORKDIR /usr/src/montel/
RUN docker-php-ext-install pdo pdo_mysql
CMD ["php", "artisan", "serve","--host=0.0.0.0"]