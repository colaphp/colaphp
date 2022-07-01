<!DOCTYPE html>
<html lang="zh-Hans">
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <title>{{ $page_title ?? '' }}</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/layui/dist/css/layui.css') }}">
    <script type="text/javascript" src="{{ asset('assets/layui/dist/layui.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vue/dist/vue.min.js') }}"></script>
    <link rel="stylesheet" href="{{ skin('css/user.css') }}">
    <script type="text/javascript" src="{{ skin('js/user.js') }}"></script>
</head>
<body>
<div class="container">
    @yield('content')
</div>
</body>
</html>
