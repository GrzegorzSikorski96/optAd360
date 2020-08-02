FROM php:7.4.0-fpm-alpine

RUN apk add --no-cache zip libzip-dev
RUN docker-php-ext-install mysqli pdo pdo_mysql bcmath \
    && apk --no-cache add git