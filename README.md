# ColaPHP 🏝️

一款基于 Workerman 的高性能 PHP HTTP 服务框架。

### 开发准备

- 运行环境要求 PHP8.1。

### 升级 composer

打开终端，执行命令：

```
composer selfupdate
```

### 克隆代码

进入 www 目录下，执行命令：

```
composer create-project colasoft/colaphp
```

### 开启调试模式

应用默认是部署模式，在开发阶段，可以修改环境变量APP_DEBUG开启调试模式，上线部署后切换到部署模式。

本地开发的时候可以在应用根目录下面定义.env文件。

### 测试运行

现在只需要做最后一步来验证是否正常运行。

进入命令行下面，执行下面指令

```
php artisan serve
```

### 正式运行

daemon方式运行(用于正式环境)

`php artisan serve -d`

### 预览

在浏览器中输入地址：

http://localhost:8080/

### License

Apache-2.0
