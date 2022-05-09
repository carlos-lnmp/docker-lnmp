FROM php:7.3.18-fpm

LABEL maintainer="crazycarlos <984010062@qq.com>" version="${PHP_VERSION}" description="php-fpm:${PHP_VERSION}"

# docker中php扩展安装方式
# 1、PHP源码文件目录自带扩展 docker-php-ext-install直接安装
# 2、pecl扩展 因为一些扩展不包含在PHP源码文件中，PHP 的扩展库仓库中存在。用 pecl install 安装扩展，再用 docker-php-ext-enable 命令 启用扩展
# 3、其他扩展 一些既不在 PHP 源码包，也不再 PECL 扩展仓库中的扩展，可以通过下载扩展程序源码，编译安装的方式安装

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

# swoole安装 如果以后用到的话，不用再安装了，4.0之后性能更好 https://github.com/swoole/swoole-src
ENV SWOOLE_VERSION 4.5.10

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
