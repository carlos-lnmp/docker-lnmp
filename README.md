# docker-lnmp
docker linux-debian nginx redis
php7.3.18 php5.6 mysql5.7  
## 镜像地址
参考阿里云：docker-carlos/dlnmp
## 启动
可以下载阿里云我生成好的镜像，也可以再本地通过命令生成本地镜像
阿里云镜像
阿里云镜像下载密码 tester@1212.com
```
docker pull registry.cn-chengdu.aliyuncs.com/docker-carlos/dlnmp:7.3.18
docker pull registry.cn-chengdu.aliyuncs.com/docker-carlos/dlnmp:5.6
```
本地生成
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
