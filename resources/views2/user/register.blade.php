@extends('layouts.app')

@section('content')
    User Register
    <form action="" method="post">
        <input type="submit" value="submit">
        {:token_field()}
    </form>

    <script type="text/javascript">
        layer.open({
            type: 2,
            title: '用户注册协议和隐私政策',
            content: 'http://sentsin.com' //这里content是一个URL，如果你不想让iframe出现滚动条，你还可以content: ['http://sentsin.com', 'no']
        });
    </script>
@endsection
