@extends('back.layouts.index')

@section('title','添加管理员')

@section('content')
    <div class="weadmin-body">
        <form class="layui-form">
            @csrf
            <div class="layui-form-item">
                <label for="account" class="layui-form-label">
                    <span class="we-red">*</span>登录名
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="account" name="account" required="" lay-verify="username"
                           autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="we-red">*</span>将会成为您唯一的登入名
                </div>
            </div>
            <div class="layui-form-item">
                <label for="name" class="layui-form-label">
                    <span class="we-red">*</span>登录名
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="name" name="name" required="" lay-verify="username"
                           autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="we-red">*</span>将会成为您唯一的登入名
                </div>
            </div>
            <div class="layui-form-item">
                <label for="phone" class="layui-form-label">
                    <span class="we-red">*</span>手机
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="phone" name="phone" required="" lay-verify="phone"
                           autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="we-red">*</span>将会成为您唯一的登入名
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_email" class="layui-form-label">
                    <span class="we-red">*</span>邮箱
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_email" name="email" required="" lay-verify="email"
                           autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="we-red">*</span>
                </div>
            </div>
            {{--<div class="layui-form-item">--}}
                {{--<label class="layui-form-label"><span class="we-red">*</span>角色</label>--}}
                {{--<div class="layui-input-block">--}}
                    {{--<input type="checkbox" name="like1[write]" lay-skin="primary" title="超级管理员" checked="">--}}
                    {{--<input type="checkbox" name="like1[read]" lay-skin="primary" title="编辑人员">--}}
                    {{--<input type="checkbox" name="like1[write]" lay-skin="primary" title="宣传人员" checked="">--}}
                {{--</div>--}}
            {{--</div>--}}
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label">
                    <span class="we-red">*</span>密码
                </label>
                <div class="layui-input-inline">
                    <input type="password" id="L_pass" name="pass" required="" lay-verify="pass"
                           autocomplete="new-password" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    6到16个字符
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label">
                    <span class="we-red">*</span>确认密码
                </label>
                <div class="layui-input-inline">
                    <input type="password" id="L_repass" name="repass" required="" lay-verify="repass"
                           autocomplete="new-password" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label"></label>
                <button  class="layui-btn" lay-filter="add" lay-submit="">增加</button>
            </div>
        </form>
    </div>
@endsection

@section('addjs')
    <script>
        layui.use(['form'], function(){
            var form = layui.form
            form.render();
            //自定义验证规则
            form.verify({
                username: function(value){
                    if(value.length < 5){
                        return '昵称至少得5个字符啊';
                    }
                }
                ,pass: [/(.+){6,12}$/, '密码必须6到12位']
                ,repass: function(value){
                    if($('#L_pass').val()!=$('#L_repass').val()){
                        return '两次密码不一致';
                    }
                }
            });
            //监听提交
            form.on('submit(add)', function(data){
                console.log(data);
                //发异步，把数据提交给php
                $.post("{{route('back.admin.register')}}",
                    {
                        'name' : data.field.name,
                        'account' : data.field.account,
                        'password' : data.field.pass,
                        'password_confirmation' : data.field.repass,
                        'email' : data.field.email,
                        'phone' : data.field.phone
                    },function (res){
                        console.log(res)
                        layer.alert("增加成功", {icon: 6},function () {
                            // 获得frame索引
                            var index = parent.layer.getFrameIndex(window.name);
                            //关闭当前frame
                            parent.layer.close(index);
                        });
                    })
                return false;
            });

        });
    </script>
@endsection
