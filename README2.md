# FlamePHP

> 运行环境要求 PHP8，启用 Redis 等扩展。

## 安装 MySql

```shell
docker run -d --name mysql -p 3306:3306 -v %CD%/docker/mysql/data:/var/lib/mysql -e MYSQL_ROOT_PASSWORD=root mysql:latest --character-set-server=utf8mb4 --collation-server=utf8mb4_unicode_ci
```

## 安装 Redis

```shell
docker run -d --name redis -p 6379:6379 redis:latest redis-server --save 60 1 --loglevel warning
```

## 安装 rabbitMQ
```shell
docker run -d --hostname rabbit --name rabbit -p 8001:15672 -e RABBITMQ_DEFAULT_USER=root -e RABBITMQ_DEFAULT_PASS=root -e RABBITMQ_DEFAULT_VHOST=default_vhost rabbitmq:3-management
```

## 环境准备

### Docker 环境

```shell
docker build -t apache-php8 docker
docker run --rm -d --name xiehua-auth -v %cd%:/var/www/html -v %cd%/docker/conf:/etc/apache2/sites-enabled -p 8000:80 apache-php8
```

注意在`cmd`模式下运行以上代码。

### WSL2 环境

如果你想通过使用 Ondřej Surý 的 `https://packages.sury.org/php/` Debian 包仓库，并结合第一条命令来安装 PHP8，你需要按照以下步骤操作：

### 步骤 1: 添加仓库到 Debian 或 Ubuntu 系统

1. **导入仓库的 GPG 密钥**：
   这个步骤是为了验证从仓库下载的包的真实性。
   ```bash
   sudo apt install apt-transport-https lsb-release ca-certificates curl
   curl -sS https://packages.sury.org/php/apt.gpg | sudo apt-key add -
   ```

2. **添加仓库**：
   通过添加仓库地址到系统的软件源列表。
   ```bash
   echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | sudo tee /etc/apt/sources.list.d/php.list
   ```

3. **更新软件包信息**：
   ```bash
   sudo apt update
   ```

### 步骤 2: 安装 PHP8 和相关包

接下来，你可以安装特定的 PHP8 版本和相关的包。

```bash
sudo apt install php8.3-{cli,curl,bcmath,dev,dom,gd,intl,mbstring,mysql,opcache,redis,sqlite3,swoole,zip}
```

### 步骤 3: 安装其他依赖包

对于其他不需要特定 PHP 版本的包，你可以如下安装：

```bash
sudo apt install git gcc libevent-dev -y
```

这样，你就通过 `https://packages.sury.org/php/` 仓库成功地安装了 PHP8，同时也安装了初始命令中提到的其他必需软件包。这种方法特别适用于那些希望从一个特定来源获取最新或特定版本 PHP 包的用户，确保系统的 PHP 环境始终是最新的。

### 步骤 4: 安装 PHP 其他扩展

```shell
sudo pecl channel-update pecl.php.net
sudo pecl install event
```

另外也可以参考 PHPUnit [部署文档](https://docs.phpunit.de/en/11.1/installation.html)，基于 Debian 快速搭建开发环境。

### WAMP 环境

推荐使用 [Laragon](https://laragon.org/download/) 集成开发环境。

## 快速开始

### 克隆代码

```shell
composer config -g repos.packagist composer https://packagist.pages.dev
composer install
```

### ENV配置

```
cp .env.example .env
```

### 数据库配置

编辑 .env 文件，修改数据库连接信息：

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=force
DB_USERNAME=root
DB_PASSWORD=
```

### 数据迁移

```
php artisan migrate
```

### 数据填充

```
php artisan seed:run
```

### 启动运行

现在只需要做最后一步来验证是否正常运行。

进入命令行下面，执行下面指令

```
php artisan serve
```

在浏览器中输入地址：

http://127.0.0.1:8000/

## Worker 服务

如果业务并发连接数大于1024必须安装 `event` 扩展，并且优化Linux内核。

### 安装 pcntl 和 posix 扩展

- centos系统

如果php是通过yum安装的，则命令行运行 `yum install php-process` 即可安装pcntl和posix扩展。

如果安装失败或者php本身不是用yum安装的请使用源码编译安装。

- debian/ubuntu/mac os系统

请使用源码编译安装。

### 安装 event 扩展

为了能支持更大的并发连接数，必须安装 `event` 扩展，并且优化Linux内核。安装方法如下:

- centos系统
1、安装event扩展依赖的libevent-devel包，命令行运行
```shell
yum install libevent-devel -y
# 如果无法安装，尝试使用下面的命令
# yum install libevent2-devel -y
```

2、安装event扩展，命令行运行
(event扩展要求PHP>=5.4)
```shell
pecl install event
```
注意提示：`Include libevent OpenSSL support [yes]` : 时输入`no`回车，其它直接敲回车就行

3、运行php --ini找到并打开php.ini文件，在最后一行加入如下配置
```shell
extension=event.so
```

- debian/ubuntu系统安装

1、安装event扩展依赖的libevent-dev包，命令行运行
```shell
apt-get install libevent-dev -y
# 如果无法安装，请尝试以下命令
# apt-get install libevent2-dev -y
```

2、安装event扩展，命令行运行
```shell
pecl install event
```
注意提示：`Include libevent OpenSSL support [yes]` : 时输入`no`回车，其它直接敲回车就行

3、运行php --ini找到并打开php.ini文件，在最后一行加入如下配置
```shell
extension=event.so
```

## 开发

### 目录结构

```
├── app                    核心应用目录
│   ├── api                API访问模块
│   │   ├── auth           统一认证接口
│   │   │   ├── controller 业务控制器
│   │   │   ├── request    业务请求类
│   │   │   ├── response   业务响应类
│   │   │   └── service    业务服务类
│   │   └── common         公共模块接口
│   ├── console            控制台程序类
│   ├── constant           应用常量
│   ├── contract           契约接口类
│   ├── entity             数据表实体类
│   ├── enums              枚举类
│   ├── exception          异常类
│   ├── jobs               异步任务类
│   ├── manager            外部接口服务类
│   ├── model              数据表模型类
│   ├── repository         DAO数据访问
│   ├── service            公共业务服务
│   └── support            支持工具包
├── artisan                控制台脚本入口
├── bootstrap              启动目录
│   └── app.php            应用准备程序
├── composer.json          composer依赖
├── composer.lock           
├── config                 全局配置
│   ├── app.php            应用配置
│   ├── cache.php          缓存配置
│   ├── cookie.php         cookie配置
│   ├── database.php       数据库配置
│   ├── dingtalk.php       钉钉配置
│   ├── filesystem.php     文件系统配置
│   ├── jwt.php            JWT配置
│   ├── log.php            日志配置
│   ├── mail.php           邮件配置
│   ├── phinx.php          数据迁移配置
│   ├── queue.php          队列配置
│   ├── route.php          路由配置
│   ├── sms.php            短信配置
│   └── wechat.php         微信配置
├── database               数据库文件
│   ├── create_func.sql    自定义MySQL函数
│   ├── migrations         数据迁移文件
│   └── seeders            数据填充文件
├── docker                 docker 配置
│   ├── conf               容器配置
│   └── Dockerfile         Dockerfile
├── docs                   文档目录
├── package                核心框架
├── phpunit.xml            phpunit 配置
├── public                 公网访问入口
│   ├── apidoc             swagger ui
│   ├── data               公开文件目录
│   ├── favicon.ico        
│   ├── index.php          程序入口
│   ├── robots.txt         
│   └── storage            本地文件存储目录
├── README.md              项目介绍
├── resource               资源文件目录
│   └── emails             邮件模板
├── runtime                运行时目录
│   ├── cache              运行时缓存
│   └── logs               运行时日志
├── scripts                脚本目录
├── tests                  测试目录
│   ├── feature            功能测试
│   ├── TestCase.php       测试基类
│   └── unit               单元测试
└── vendor                 composer包
```

### 请求周期

开发实行分层调用：

```
API 网关 -> index.php -> 启动核心框架
	-> request 请求验证层（表单验证）
	-> controller 按照MCA路由分发处理请求（M：模块，C：控制器，A：处理方法）
	-> service 调用业务逻辑服务层
	-> manager 通用逻辑层（如外部短信服务等）
	-> model 调用数据表关系模型层
	-> DB 底层查询数据库
```

返回的数据按照逆向数据流响应给客户端的API.

### 配置伪静态

打开生成的 nginx 配置文件，设置伪静态规则：

```
location / {
    if (!-f $request_filename) {
   	    rewrite  ^(.*)$  /index.php?r=/$1  last;
    }
}
```

### 生成代码和API文档

```shell
./scripts/gen.sh
```

### 调试模式

应用默认是部署模式，在开发阶段，可以修改环境变量APP_DEBUG开启调试模式，上线部署后切换到部署模式。

本地开发的时候可以在应用根目录下面定义.env文件。
