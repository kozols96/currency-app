FROM php:8.2-fpm-alpine

ARG WORKDIR=/var/www/html
ARG USER
ARG GROUP

WORKDIR $WORKDIR

RUN apk update && apk upgrade
RUN apk add --update --no-cache bash \
    curl \
    git \
    zip \
    libzip-dev \
    unzip \
    acl \
    fcgi \
    file \
    gettext \
    libgomp \
    imagemagick \
    imagemagick-dev \
    icu-dev \
    libpq-dev \
    oniguruma-dev \
    autoconf \
    gcc \
    g++ \
    zlib-dev \
    make \
    linux-headers

RUN docker-php-ext-install opcache \
    pdo \
    pdo_pgsql \
    zip \
    mbstring \
    exif \
    intl

RUN pecl install imagick \
    && docker-php-ext-enable imagick

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN pecl install redis \
    && docker-php-ext-enable redis

COPY --from=composer /usr/bin/composer /usr/local/bin/composer

RUN addgroup -g 1000 -S $GROUP && adduser -u 1000 -G $GROUP -S $USER
RUN chown -R $USER:$GROUP .

USER $USER
