FROM php:5.6-fpm
MAINTAINER crazycarlos <984010062.com>

# 设置时间
RUN /bin/cp /usr/share/zoneinfo/Asia/Shanghai /etc/localtime \
    && echo 'Asia/Shanghai' > /etc/timezone

# Mysqli 扩展 自带 直接安装即可(当前数据库使用的mysqli查询的)
RUN docker-php-ext-install mysqli

# PDO 扩展 自带 直接安装即可
RUN docker-php-ext-install pdo_mysql

# Bcmath 扩展 自带 直接安装即可
RUN docker-php-ext-install bcmath

# opcache 扩展安装 
RUN docker-php-ext-configure opcache --enable-opcache && docker-php-ext-install opcache

RUN apt-get update && \
    apt-get install -y \
    libzip-dev \
    && docker-php-ext-install zip
    