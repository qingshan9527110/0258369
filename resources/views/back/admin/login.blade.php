<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>管理员登录</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon" />
    <link rel="stylesheet" href="{{asset('static/css/font.css')}}">
    <link rel="stylesheet" href="{{asset('static/css/weadmin.css')}}">
    <script src="{{asset('lib/layui/layui.js')}}" charset="utf-8"></script>

</head>
<body class="login-bg">

<div class="login">
    <div class="message">管理登录</div>
    <div id="darkbannerwrap"></div>

    <form method="post" class="layui-form" action="{{route('back.admin.login')}}">
        @csrf
        <input name="account" placeholder="用户名"  type="text" class="layui-input" value="{{old('account')}}">
        <hr class="hr15">
        <input name="password"  placeholder="密码"  type="password" class="layui-input">
        @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
        <hr class="hr15">
        <input class="loginin" value="登录" style="width:100%;" type="submit">
        <hr class="hr20" >
        <div>
            前端静态展示，请随意输入，即可登录。
        </div>
    </form>
</div>

<script type="text/javascript">


</script>
<!-- 底部结束 -->
</body>
</html>
