# PHPMall 🏝️

> 👷 Under development. Releasing soon.

### 开发准备

- 运行环境要求 PHP8.0。
- 下载并安装 Microsoft Visual C++ Redistributable for Visual Studio 2019，地址：https://visualstudio.microsoft.com/zh-hans/downloads/
- 下载 PHP8 https://windows.php.net/download/#php-8.0-ts-vs16-x64 ，并解压到 bin/php 目录下
- 安装 sourcetree https://www.sourcetreeapp.com/

### 设置阿里云composer代理**

由于国内访问composer比较慢，建议设置阿里云composer镜像，运行如下命令设置阿里云代理

`composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/`

### 升级 composer

打开控制台，执行命令：

```
composer selfupdate
```

### 克隆代码

进入 www 目录下，鼠标右击打开控制台，执行命令：

```
composer create-project phpmall/phpmall
```

### 开启调试模式

应用默认是部署模式，在开发阶段，可以修改环境变量APP_DEBUG开启调试模式，上线部署后切换到部署模式。

本地开发的时候可以在应用根目录下面定义.env文件。

### 测试运行

现在只需要做最后一步来验证是否正常运行。

进入命令行下面，执行下面指令

debug方式运行(用于开发环境)
 
`php artisan serve`

### 正式运行

daemon方式运行(用于正式环境)

`php artisan serve -d`

### 预览

在浏览器中输入地址：

http://localhost:8000/

### 项目目录介绍

```
app                   核心应用文件
  controller          控制器文件
	console           平台接口
	shop              店铺接口
	user              消费者接口
	wechat            微信接口
  exception           异常文件
  handler             微信公众平台消息处理类
  middleware          中间件
  model               数据库表模型
  provider            服务提供者
  request             请求类
  response            响应类
  service             核心业务服务
  support             支持文件
bootstrap             核心框架启动文件
```

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

### License

Apache-2.0
