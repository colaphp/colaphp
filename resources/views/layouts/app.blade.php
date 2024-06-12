<!DOCTYPE html>
<html lang="zh-Hans">
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <title>{{ $page_title ?? '' }}</title>
    <link rel="stylesheet" href="{{ asset('assets/layui/dist/css/layui.css?v=2.8.16') }}">
    <link rel="stylesheet" href="{{ asset('themes/default/css/app.css') }}">
    <script src="{{ asset('assets/jquery/dist/jquery.min.js?v=3.7.1') }}"></script>
    <script src="{{ asset('assets/layui/dist/layui.js?v=2.8.16') }}"></script>
    <script src="{{ asset('assets/vue/dist/vue.min.js?v=2.6.14') }}"></script>
</head>
<body>
@yield('content')
<script src="{{ asset('themes/default/js/app.js') }}"></script>
</body>
</html>
