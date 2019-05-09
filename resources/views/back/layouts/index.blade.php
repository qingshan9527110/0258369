<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon" />
    <link rel="stylesheet" href="{{asset('static/css/font.css')}}">
    <link rel="stylesheet" href="{{asset('static/css/weadmin.css')}}">
    <script type="text/javascript" src="{{asset('lib/layui/layui.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{asset('js/function.js')}}"></script>
    <script type="text/javascript" src="{{asset('static/js/jquery-3.3.1.min.js')}}" charset="utf-8"></script>
    @yield('addcss')
</head>
<body>
    @yield('content')


    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        layui.config({
            base: '/static/js/'
            ,version: '101100'
        }).extend({
            admins: '{/}/static/js/admins',
            treeGird: '{/}/lib/layui/lay/treeGird' // {/}的意思即代表采用自有路径，即不跟随 base 路径
        });
    </script>

    <script src="{{asset('static/js/eleDel.js')}}" type="text/javascript" charset="utf-8"></script>
    @yield('addjs')
</body>
</html>
