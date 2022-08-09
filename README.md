# docker-lnmp

可以更方便的管理php环境。

此项目只针对win10系统，Linux暂时没有经过测试，也不会测试Linux因为这个项目是我自己用的，
如果想在Linux上运行需自己测试。

用docker-compose管理，容器包括Nginx、PHP7.3.18、PHP5.6、MySQL5.7、Redis

#新增加

consul服务、nacos服务

nacos+prometheus+grafana 监控nacos

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
   |--php56/conf.d/php.ini
   |--php73/conf.d/php.ini
   |--php74/conf.d/php.ini
   |--php80/conf.d/php.ini
   |--redis
|--data                   数据目录
   |--mysql
   |--redis
|--log                    日志目录
   |--mysql               
   |--nginx               
   |--php56                 
   |--php73                 
   |--php74                 
   |--php80                 
   |--redis               
|--www                    项目文件
   |--php56               
   |--php73               
   |--php74               
   |--php80               
|--service                镜像文件
   |--php56
   |--php73
   |--php74
   |--php80
```

## 拉取镜像
```
$ git clone https://github.com/carlos-lnmp/docker-lnmp.git
```

## 镜像说明 
只有php镜像是需要Dockerfile。本地构建时间会过长，推荐使用阿里云构建。
### Nginx
采用docker官方镜像，镜像版本使用最新版
### PHP5.6

已经安装的扩展
```
[PHP Modules]
bcmath
bz2
Core
ctype
curl
date
dba
dom
ereg
fileinfo
filter
ftp
gd
hash
iconv
json
libxml
mbstring
memcache
memcached
mhash
mongodb
msgpack
mysqli
mysqlnd
openssl
pcre
PDO
pdo_mysql
pdo_sqlite
Phar
posix
readline
redis
Reflection
session
SimpleXML
sockets
SPL
sqlite3
standard
tokenizer
xml
xmlreader
xmlwriter
Zend OPcache
zip
zlib

[Zend Modules]
Zend OPcache
```

采用docker官方镜像，镜像版本采用php:5.6-fpm
### PHP7.3.18

已经安装的扩展
```
[PHP Modules]
bcmath       
bz2
Core
ctype        
curl
date
dba
dom
fileinfo
filter
ftp
gd
hash
iconv
json
libxml
mbstring
memcache
memcached
mongodb
msgpack
mysqli
mysqlnd
openssl
pcre
PDO
pdo_mysql
pdo_sqlite
Phar
posix
readline
redis
Reflection
session
SimpleXML
sockets
sodium
SPL
sqlite3
standard
swoole
tokenizer
xml
xmlreader
xmlwriter
Zend OPcache
zip
zlib

[Zend Modules]
Zend OPcache
```

采用docker官方镜像，镜像版本采用php:7.3.18-fpm
### PHP7.4.29

已经安装的扩展
```
[PHP Modules]
bcmath       
bz2
Core
ctype        
curl
date
dba
dom
fileinfo
filter
ftp
gd
hash
iconv
json
libxml
mbstring
memcache
memcached
mongodb
msgpack
mysqli
mysqlnd
openssl
pcre
PDO
pdo_mysql
pdo_sqlite
Phar
posix
readline
redis
Reflection
session
SimpleXML
sockets
sodium
SPL
sqlite3
standard
swoole
tokenizer
xml
xmlreader
xmlwriter
Zend OPcache
zip
zlib

[Zend Modules]
Zend OPcache
```

采用docker官方镜像，镜像版本采用php:7.4.29-fpm
### PHP8.0.20-fpm-alpine3.15

已经安装的扩展
```
[PHP Modules]
amqp
bcmath       
Core
ctype        
curl
date
dom
fileinfo     
filter       
ftp
gd
hash
iconv
json
libxml
mbstring
memcache
memcached
mongodb
msgpack
mysqli
mysqlnd
openssl
pcntl
pcre
PDO
pdo_mysql
pdo_sqlite
Phar
posix
protobuf
readline
redis
Reflection
session
SimpleXML
sockets
sodium
SPL
sqlite3
standard
swoole
tokenizer
xml
xmlreader
xmlwriter
Zend OPcache
zip
zlib

[Zend Modules]
Zend OPcache
```

采用docker官方镜像，镜像版本采用php:8.0.20-fpm-alpine3.15
### MySQL5.7
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
