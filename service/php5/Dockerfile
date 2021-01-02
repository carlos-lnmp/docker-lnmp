FROM php:5.6-fpm
LABEL maintainer="crazycarlos <984010062@qq.com>" version="5.6" description="php-fpm:5.6"

# 设置时间
RUN /bin/cp /usr/share/zoneinfo/Asia/Shanghai /etc/localtime \
    && echo 'Asia/Shanghai' > /etc/timezone

RUN apt-get update && \
    apt-get install -y \
    libzip-dev \
    \
    && docker-php-ext-configure opcache --enable-opcache \
    && docker-php-ext-install mysqli pdo_mysql bcmath zip opcache \

    