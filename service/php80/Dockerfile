FROM php:8.0.20-fpm-alpine3.15

LABEL maintainer="crazycarlos <984010062@qq.com>" version="8.0" description="php:8.0-fpm-alpine3.15"

ENV PROTOBUF_VERSION 3.21.0
ENV PHPREDIS_VERSION 5.3.6
ENV MSGPACK_VERSION 2.1.2
ENV MEMCACHED_VERSION 3.2.0
ENV MEMCACHE_VERSION 8.0
ENV MONGODB_VERSION 1.12.1
ENV SWOOLE_VERSION 4.8.10
ENV AMQP_VERSION 1.11.0

# 设置时间
RUN apk add tzdata && cp /usr/share/zoneinfo/Asia/Shanghai /etc/localtime \
    && echo 'Asia/Shanghai' > /etc/timezone \
    && apk del tzdata

COPY resources/ /tmp/resources/

# 扩展依赖
RUN apk update \
    && apk add --no-cache \
        git \
        openssh \
        bash \
        gcc \
        g++ \
        m4 \
        autoconf \
        make \
        pcre-dev \
        wget \
        curl \
        # amqp
        libc-dev \
        cmake \
        rabbitmq-c \
        rabbitmq-c-dev \
        # swoole
        openssl-dev \
        curl-dev \
        # mcrypt
        libmcrypt-dev \
        # memcached
        libmemcached-dev \
        # gd
        libpng-dev \
        freetype-dev \
        libjpeg-turbo-dev \
        # zip
        libzip-dev \
    && php -v \
    && php -i \
    && php -m \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-configure opcache --enable-opcache \
    && docker-php-ext-install -j$(nproc) sockets mysqli pdo_mysql gd bcmath pcntl opcache \
    && docker-php-ext-install -j 2 zip \
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
    && /bin/bash -lc "pecl install /tmp/resources/amqp-${AMQP_VERSION}.tgz" \
    && docker-php-ext-enable amqp \
    \
    && tar -zxvf /tmp/resources/memcache-${MEMCACHE_VERSION}.tgz -C /tmp/resources/ \
    && cd /tmp/resources/memcache-${MEMCACHE_VERSION} \
    && phpize \
    && ./configure --with-php-config=/usr/local/bin/php-config \
    && make -j$(nproc) \
    && make install \
    && docker-php-ext-enable memcache \
    \
    && tar -zxvf /tmp/resources/mongodb-${MONGODB_VERSION}.tgz -C /tmp/resources/ \
    && cd /tmp/resources/mongodb-${MONGODB_VERSION} \
    && phpize \
    && ./configure --with-php-config=/usr/local/bin/php-config \
    && make -j$(nproc) \
    && make install \
    && docker-php-ext-enable mongodb \
    \
    && tar -zxvf /tmp/resources/swoole-${SWOOLE_VERSION}.tgz -C /tmp/resources/ \
    && cd /tmp/resources/swoole-${SWOOLE_VERSION} \
    && phpize \
    && ./configure --enable-openssl --enable-http2 --enable-swoole-curl --enable-swoole-json --enable-mysqlnd --with-php-config=/usr/local/bin/php-config \
    && make -j$(nproc) \
    && make install \
    && docker-php-ext-enable swoole \
    \
    && docker-php-source delete \
    \
    && rm -rf /tmp/resources/ \
    && cd ~ \
    && php -m