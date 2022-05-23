FROM php:7.4.29-fpm

LABEL maintainer="crazycarlos <984010062@qq.com>" version="7.4.29" description="php:7.4.29"

# 扩展版本号定义 

# redis 扩展 pecl扩展
ENV PHPREDIS_VERSION 5.2.2

# msgpack扩展 pecl扩展
ENV MSGPACK_VERSION 2.1.0

# memcache扩展 pecl扩展
ENV MEMCACHE_VERSION 4.0.5.2

# memcached扩展 pecl扩展
ENV MEMCACHED_VERSION 3.1.5

# mongodb扩展 pecl扩展
ENV MONGODB_VERSION 1.7.4

# swoole安装
ENV SWOOLE_VERSION 4.5.1

# 设置时间
RUN /bin/cp /usr/share/zoneinfo/Asia/Shanghai /etc/localtime \
    && echo 'Asia/Shanghai' > /etc/timezone

COPY resources/ /tmp/resources/

# 扩展依赖
RUN apt-get update \
    && apt-get install -y \
        curl \
        wget \
        zip \
        openssl \
        libz-dev \
        libbz2-dev \
        libssl-dev \
        libpcre3-dev \
        libmemcached-dev \
        zlib1g-dev \
        libfreetype6-dev \
        libjpeg-dev \
        libpng-dev \
        libwebp-dev \
        libzip-dev \
    && docker-php-ext-configure gd \
        --with-webp-dir=/usr/include/webp \
        --with-jpeg-dir=/usr/include \
        --with-png-dir=/usr/include \
        --with-freetype-dir=/usr/include/freetype2 \
    && docker-php-ext-configure opcache --enable-opcache \
    && docker-php-ext-install -j$(nproc) bz2 dba sockets gd mysqli pdo_mysql bcmath zip opcache \
    \
    && curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && chmod -R 777 /usr/local/bin/composer \
    && composer self-update --clean-backups \
    && composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/ \
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
    && tar -zxf /tmp/resources/swoole-src-${SWOOLE_VERSION}.tar.gz -C /tmp/resources/ \
    && cd /tmp/resources/swoole-src-${SWOOLE_VERSION} \
    && phpize \
    && ./configure --enable-openssl --enable-http2 --enable-swoole-curl --enable-swoole-json \
    && make -j$(nproc) \
    && make install \
    && docker-php-ext-enable swoole \
    \
    && rm -rf /tmp/resources/ \
    && cd ~ \
    \
    && apt-get -y clean
