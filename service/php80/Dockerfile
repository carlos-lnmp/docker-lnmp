FROM php:8.0-alpine3.16

LABEL maintainer="crazycarlos <984010062@qq.com>" version="8.0" description="php:8.0-fpm-alpine3.16"

ENV PROTOBUF_VERSION 3.21.0
ENV PHPREDIS_VERSION 5.3.6
ENV MSGPACK_VERSION 2.1.2
ENV MEMCACHED_VERSION 3.2.0
ENV MEMCACHE_VERSION 8.0
ENV MONGODB_VERSION 1.12.1
ENV SWOOLE_VERSION 4.8.10

# 设置时间
RUN apk add tzdata && cp /usr/share/zoneinfo/Asia/Shanghai /etc/localtime \
    && echo 'Asia/Shanghai' > /etc/timezone \
    && apk del tzdata

COPY resources/ /tmp/resources/

# 扩展依赖
RUN apk update \
    && apk add --no-cache \
        curl \
        wget \
        libc-dev \
        openssl \
        zip \
        libzip-dev \
        libmemcached-dev \
        libpng-dev \
        freetype-dev \
        libjpeg-turbo-dev \
    && php -m \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-configure opcache --enable-opcache \
    && docker-php-ext-install -j$(nproc) gd bcmath pcntl zip opcache \
    \
    && curl -sS https://getcomposer.org/installer | php \
    && chmod +x composer.phar \
    && mv composer.phar /usr/local/bin/composer \
#    && chmod +x /usr/local/bin/composer \
    && composer self-update --clean-backups \
    && composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/ \
    \
    && pecl install /tmp/resources/protobuf-${PROTOBUF_VERSION}.tgz \
    && docker-php-ext-enable protobuf \
    \
    && pecl install /tmp/resources/redis-${PHPREDIS_VERSION}.tgz \
    && docker-php-ext-enable redis \
    \
    && pecl install /tmp/resources/msgpack-${MSGPACK_VERSION}.tgz \
    && docker-php-ext-enable msgpack \
    \
    && pecl install /tmp/resources/memcached-${MEMCACHED_VERSION}.tgz \
    && docker-php-ext-enable memcached \
    \
    && pecl install /tmp/resources/memcache-${MEMCACHE_VERSION}.tgz \
    && docker-php-ext-enable memcache \
    \
    && pecl install /tmp/resources/mongodb-${MONGODB_VERSION}.tgz \
    && docker-php-ext-enable mongodb \
    \
    && pecl install /tmp/resources/swoole-src-${SWOOLE_VERSION}.tgz \
    && docker-php-ext-enable swoole \
    \
    && rm -rf /tmp/resources/ \
    && cd ~ \
    && php -m \
