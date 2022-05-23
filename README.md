# docker-lnmp

可以更方便的管理php环境。

此项目只针对win10系统，Linux暂时没有经过测试，也不会测试Linux因为这个项目是我自己用的，
如果想在Linux上运行需自己测试。

用docker-compose管理，容器包括Nginx、PHP7.3.18、PHP5.6、MySQL5.7、Redis

## 目录说明
```
dlnmp
|--conf                   配置文件
   |--mysql
   |--nginx
      |--conf.d
         |--website       项目配置目录
      |--ssl              https配置目录
      |----nginx.conf
   |--php
   |--redis
|--data                   数据目录
   |--mysql
   |--redis
|--log                    日志目录
   |--mysql               
   |--nginx               
   |--php                 
   |--redis               
|--html                   项目文件
|--html56                 项目文件
|--service                镜像文件
   |--php56
   |--php73
```

## 拉取镜像
```
$ git clone https://github.com/carlos-lnmp/docker-lnmp.git
```

## 镜像说明 
只有php镜像是需要Dockerfile。本地构建时间会过长，推荐使用阿里云构建。
##### Nginx
采用docker官方镜像，镜像版本使用最新版
##### PHP7.3.18
采用docker官方镜像，镜像版本采用php:7.3.18-fpm
##### PHP5.6
采用docker官方镜像，镜像版本采用php:5.6-fpm
##### MySQL5.7
采用docker官方镜像，镜像版本采用mysql:5.7
##### Redis
采用docker官方镜像，镜像版本使用最新版

## 启动
```
docker-compose up -d
```
## docker 常用命令
列出容器列表
```
docker ps -a 
```
查看容器日志
```
docker log [容器名称] 
```
进入容器
```
docker exec -it [容器名称] bash 
```
