<!DOCTYPE html>
<html lang="zh-Hans">
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $page_title ?? '' }}会员中心</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/layui@2.6.8/css/layui.css') }}">
    <script type="text/javascript" src="{{ asset('assets/layui@2.6.8/layui.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vuejs@2.6.14/vue.min.js') }}"></script>
    <link rel="stylesheet" href="{{ skin('css/common.css') }}">
</head>
<body>
@yield('content')
</body>
</html>
