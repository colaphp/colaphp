<!doctype html>
<html lang="zh-Hans">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="shortcut icon" href="/favicon.ico"/>
    <title>{{ $title ?? 'untitled' }}</title>
    <link rel="stylesheet" href="/static/vendor/layui@v2.6.8/css/layui.css">
    <link rel="stylesheet" href="/static/user/css/app.css">
</head>
<body>

@yield('content')

<script src="/static/vendor/layui@v2.6.8/layui.js"></script>
<script src="/static/user/js/app.js"></script>
</body>
</html>
