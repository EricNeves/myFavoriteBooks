FROM php:8.1-fpm-alpine

WORKDIR /var/www

COPY . .

RUN apk update && apk add --no-cache unzip libpq-dev php-curl php-xml php-pgsql 

RUN docker-php-ext-install pdo pdo_pgsql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install

EXPOSE 9000

CMD [ "php-fpm" ]