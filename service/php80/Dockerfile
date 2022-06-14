FROM php:8.0-alpine3.16

LABEL maintainer="crazycarlos <984010062@qq.com>" version="8.0" description="php:8.0-fpm-alpine3.16"

# 设置时间
RUN apk add tzdata && cp /usr/share/zoneinfo/Asia/Shanghai /etc/localtime \
    && echo 'Asia/Shanghai' > /etc/timezone \
    && apk del tzdata

# 扩展依赖
RUN apk update \
    && apk add --no-cache \
        libc-dev \
        make \
        curl \
        openssl \
        libzip-dev \
        libmemcached-dev \
        libpng-dev \
        freetype-dev \
        libjpeg-turbo-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-configure opcache --enable-opcache \
    && docker-php-ext-install -j$(nproc) bz2 dba sockets gd bcmath openssl json pcntl zip opcache \
    \
    && curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && chmod -R 777 /usr/local/bin/composer \
    && composer self-update --clean-backups \
    && composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/ \
    \
    && pecl install protobuf-3.21.0 \
    && docker-php-ext-enable protobuf \
    \
    && pecl install redis-5.3.6 \
    && docker-php-ext-enable redis \
    \
    && pecl install msgpack-2.1.2 \
    && docker-php-ext-enable msgpack \
    \
    && pecl install memcached-3.2.0 \
    && docker-php-ext-enable memcached \
    \
    && pecl install memcache-8.0 \
    && docker-php-ext-enable memcache \
    \
    && pecl install mongodb-1.12.1 \
    && docker-php-ext-enable mongodb \
    \
    && pecl install swoole-4.6.7 \
    && docker-php-ext-enable swoole
