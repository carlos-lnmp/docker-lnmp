FROM php:8.0.20-fpm-alpine3.15

LABEL maintainer="crazycarlos <984010062@qq.com>" version="8.0" description="php:8.0-fpm-alpine3.15"

ENV PROTOBUF_VERSION 3.21.0
ENV PHPREDIS_VERSION 5.3.6
ENV MSGPACK_VERSION 2.1.2
ENV MEMCACHED_VERSION 3.2.0
ENV MEMCACHE_VERSION 8.0
ENV MONGODB_VERSION 1.12.1
ENV SWOOLE_VERSION 4.8.10

# 设置时间
RUN sed -i 's/dl-cdn.alpinelinux.org/mirrors.aliyun.com/g' /etc/apk/repositories
RUN apk add tzdata && cp /usr/share/zoneinfo/Asia/Shanghai /etc/localtime \
    && echo 'Asia/Shanghai' > /etc/timezone \
    && apk del tzdata

COPY resources/ /tmp/resources/

# 扩展依赖
RUN apk update \
    && apk add --no-cache \
        bash \
        gcc \
        g++ \
        m4 \
        autoconf \
        make \
        openssl-dev \
        pcre-dev \
        wget \
        curl \
        # mcrypt
        libmcrypt-dev \
        # memcached
        libmemcached-dev \
        # mongodb
        # gd
        libpng-dev \
        freetype-dev \
        libjpeg-turbo-dev \
    && php -v \
    && php -m \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-configure opcache --enable-opcache \
    && docker-php-ext-install -j$(nproc) mcrypt mysqli pdo_mysql gd bcmath pcntl opcache \
    \
    && curl -sS https://getcomposer.org/installer | php \
    && chmod +x composer.phar \
    && mv composer.phar /usr/local/bin/composer \
    && composer self-update --clean-backups \
    && composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/ \
    \
    && pecl channel-update pecl.php.net \
    && docker-php-source extract \
    \
    && /bin/bash -lc "pecl install /tmp/resources/protobuf-${PROTOBUF_VERSION}.tgz" \
    && docker-php-ext-enable protobuf \
    \
    && /bin/bash -lc "pecl install /tmp/resources/redis-${PHPREDIS_VERSION}.tgz" \
    && docker-php-ext-enable redis \
    \
    && /bin/bash -lc "pecl install /tmp/resources/msgpack-${MSGPACK_VERSION}.tgz" \
    && docker-php-ext-enable msgpack \
    \
    && /bin/bash -lc "pecl install /tmp/resources/memcached-${MEMCACHED_VERSION}.tgz" \
    && docker-php-ext-enable memcached \
    \
    && /bin/bash -lc "pecl install /tmp/resources/memcache-${MEMCACHE_VERSION}.tgz" \
    && docker-php-ext-enable memcache \
    \
    && /bin/bash -lc "pecl install /tmp/resources/mongodb-${MONGODB_VERSION}.tgz" \
#    && echo "extension=mongodb.so" >> `/usr/local/php7/bin/php --ini | grep "Loaded Configuration" | sed -e "s|.*:\s*||"` \
    && docker-php-ext-enable mongodb \
    \
    && /bin/bash -lc "pecl install /tmp/resources/swoole-src-${SWOOLE_VERSION}.tgz" \
    && docker-php-ext-enable swoole \
    \
    && docker-php-source delete \
    \
    && rm -rf /tmp/resources/ \
    && cd ~ \
    && php -m