<html>

<head>
    <meta charset="UTF-8">
    <title>欢迎页面-WeAdmin Frame型后台管理系统-WeAdmin 1.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="<?php echo csrf_token(); ?>" id="csrf-token">
    <script type="text/javascript" src="{{asset('static/js/jquery-3.3.1.min.js')}}" charset="utf-8"></script>
</head>
<body>
    <button onclick="aa()">asd</button>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function aa() {
            $.post("{{route('category.store')}}",
                {
                    'name' : 'asdasd'
                },
                function (res) {
                    console.log(res)
                }
            )
        }
    </script>
</body>
</html>
