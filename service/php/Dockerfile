FROM php:7.3.18-fpm
MAINTAINER crazycarlos <984010062.com>

# docker中php扩展安装方式
# 1、PHP源码文件目录自带扩展 docker-php-ext-install直接安装
# 2、pecl扩展 因为一些扩展不包含在PHP源码文件中，PHP 的扩展库仓库中存在。用 pecl install 安装扩展，再用 docker-php-ext-enable 命令 启用扩展
# 3、其他扩展 一些既不在 PHP 源码包，也不再 PECL 扩展仓库中的扩展，可以通过下载扩展程序源码，编译安装的方式安装

# 扩展版本号定义 

# redis 扩展
ENV PHPREDIS_VERSION 5.2.2

# msgpack扩展
ENV MSGPACK_VERSION 2.1.0

# memcache扩展
ENV MEMCACHED_VERSION 4.0.5.2

# memcached扩展
ENV MEMCACHED_VERSION 3.1.5

# mongodb扩展
ENV MONGODB_VERSION 1.7.4

# xhprof扩展 https://github.com/longxinH/xhprof/releases(pecl 不支持php7 使用这里的)
ENV XHPROF_VERSION 2.2.0

# swoole安装 如果以后用到的话，不用再安装了，4.0之后性能更好
ENV SWOOLE_VERSION 4.5.1

# swoole依赖hiredis
ENV HIREDIS_VERSION 0.14.1

# 设置时间
RUN /bin/cp /usr/share/zoneinfo/Asia/Shanghai /etc/localtime \
    && echo 'Asia/Shanghai' > /etc/timezone


# 扩展依赖
RUN apt-get update \
    && apt-get install -y \
        curl \
        wget \
        zip \
        openssl \
        libz-dev \
        libssl-dev \
        libnghttp2-dev \
        libpcre3-dev \
        libmemcached-dev \
        zlib1g-dev \
        libfreetype6-dev \
        libjpeg-dev \
        libpng-dev \
        libwebp-dev \
        libzip-dev 
#    && apt-get clean \
#    && apt-get autoremove

# Composer安装
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && composer self-update --clean-backups \
    && composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/

# gd 扩展安装 完整命令
RUN docker-php-ext-configure gd \
        --with-webp-dir=/usr/include/webp \
        --with-jpeg-dir=/usr/include \
        --with-png-dir=/usr/include \
        --with-freetype-dir=/usr/include/freetype2 \
    && docker-php-ext-install gd

# Mysqli 扩展 自带 直接安装即可(当前数据库使用的mysqli查询的)
RUN docker-php-ext-install mysqli

# PDO 扩展 自带 直接安装即可
RUN docker-php-ext-install pdo_mysql

# Bcmath 扩展 自带 直接安装即可
RUN docker-php-ext-install bcmath

# Redis 扩展下载 pecl本地安装 开启扩展
RUN wget http://pecl.php.net/get/redis-${PHPREDIS_VERSION}.tgz -O /tmp/redis.tgz \
    && pecl install /tmp/redis.tgz \
    && rm -rf /tmp/redis.tgz \
    && docker-php-ext-enable redis

# msgpack 扩展下载 pecl本地安装 开启扩展(延迟队列使用减少源数据占用空间)
RUN wget http://pecl.php.net/get/msgpack-${MSGPACK_VERSION}.tgz -O /tmp/msgpack.tgz \
    && pecl install /tmp/msgpack.tgz \
    && rm -rf /tmp/msgpack.tgz \
    && docker-php-ext-enable msgpack

# memcached 扩展下载 pecl本地安装 开启扩展 前面已经通过 apt-get安装了libmemcached-dev依赖
RUN wget http://pecl.php.net/get/memcached-${MEMCACHED_VERSION}.tgz -O /tmp/memcached.tgz \
    && pecl install /tmp/memcached.tgz \
    && rm -rf /tmp/memcached.tgz \
    && docker-php-ext-enable memcached

# memcache 扩展下载 pecl本地安装 开启扩展
RUN wget http://pecl.php.net/get/memcache-${MEMCACHED_VERSION}.tgz -O /tmp/memcache.tgz \
    && pecl install /tmp/memcache.tgz \
    && rm -rf /tmp/memcache.tgz \
    && docker-php-ext-enable memcache

# mongodb 扩展下载 pecl本地安装 开启扩展 前面已经通过 
RUN wget http://pecl.php.net/get/mongodb-${MONGODB_VERSION}.tgz -O /tmp/mongodb.tgz \
    && pecl install /tmp/mongodb.tgz \
    && rm -rf /tmp/mongodb.tgz \
    && docker-php-ext-enable mongodb


# xhprof github上下载支持php7的扩展 安装 开启扩展
#RUN wget https://github.com/longxinH/xhprof/archive/v${XHPROF_VERSION}.tar.gz -O /tmp/xhprof.tar.gz \
#    && mkdir -p /tmp/xhprof \
#    && tar -xf /tmp/xhprof.tar.gz -C /tmp/xhprof --strip-components=1 \
#    && rm /tmp/xhprof.tar.gz \
#    && ( \
#        cd /tmp/xhprof/extension \
#        && phpize \
#        && ./configure  \
#        && make -j$(nproc) \
#        && make install \
#    ) \
#    && rm -r /tmp/xhprof \
#    && docker-php-ext-enable xhprof


# Hiredis依赖安装
RUN wget https://github.com/redis/hiredis/archive/v${HIREDIS_VERSION}.tar.gz -O /tmp/hiredis.tar.gz \
  && mkdir -p /tmp/hiredis \
    && tar -xf /tmp/hiredis.tar.gz -C /tmp/hiredis --strip-components=1 \
    && rm /tmp/hiredis.tar.gz \
    && ( \
        cd /tmp/hiredis \
        && make -j$(nproc) \
        && make install \
        && ldconfig \
    ) \
    && rm -r /tmp/hiredis

# Swoole 扩展安装 开启扩展
RUN wget https://github.com/swoole/swoole-src/archive/v${SWOOLE_VERSION}.tar.gz -O /tmp/swoole.tar.gz \
    && mkdir -p /tmp/swoole \
    && tar -xf /tmp/swoole.tar.gz -C /tmp/swoole --strip-components=1 \
    && rm /tmp/swoole.tar.gz \
    && ( \
        cd /tmp/swoole \
        && phpize \
        && ./configure --enable-async-redis --enable-mysqlnd --enable-openssl --enable-http2 \
        && make -j$(nproc) \
        && make install \
    ) \
    && rm -r /tmp/swoole \
    && docker-php-ext-enable swoole

# opcache 扩展安装 
RUN docker-php-ext-configure opcache --enable-opcache && docker-php-ext-install opcache

RUN apt-get update && \
    apt-get install -y \
    libzip-dev \
    && docker-php-ext-install zip
    