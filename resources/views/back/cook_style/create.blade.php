@extends('back.layouts.index')

@section('title','添加分类')

@section('content')
<div class="weadmin-body">

    <form id="form1" class="layui-form">
        <div class="layui-form-item">
            <label class="layui-form-label">父级分类{{$pid}}</label>
            <div class="layui-input-inline">
                <select name="pid" id="pid-select" lay-verify="required" lay-filter="pid-select">
                    <option value="0" data-level="0">顶级分类</option>
                    @foreach ($list as $row)
                    <option
                        @if ($pid==$row->id)
                        selected
                        @endif
                        value="{{$row->id}}" data-level="{{$row->level}}">{{$row->name}}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">分类名称</label>
            <div class="layui-input-block">
                <input type="text" name="name" lay-verify="required" jq-error="请输入分类名称" placeholder="请输入分类名称" autocomplete="off" class="layui-input ">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">排序</label>
            <div class="layui-input-inline">
                <input type="text" name="order" lay-verify="number" value="100" jq-error="排序必须为数字" placeholder="分类排序" autocomplete="off" class="layui-input ">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">状态</label>
            <div class="layui-input-inline">
                <input type="radio" name="status" title="启用" value="0" checked />
                <input type="radio" name="status" title="禁用" value="1" />
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="add">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('addjs')
<script type="text/javascript">
    layui.use(['admins','jquery','form', 'layer'], function() {
        var admin = layui.admins,
            //$ = layui.jquery,
            form = layui.form,
            layer = layui.layer;

        //监听提交
        form.on('submit(add)', function(data) {
            console.log(data.field);
            //发异步，把数据提交给php
            $.post("{{route('back.cookStyle.store')}}",
                {
                    'name' : data.field.name,
                    'pid' : data.field.pid,
                    'status' : data.field.status,
                    'order' : data.field.order
                },function (res) {
                    console.log(res)
                    if(res){
                        layer.alert("增加成功", {
                            icon: 6
                        }, function() {
                            // 获得frame索引
                            var index = parent.layer.getFrameIndex(window.name);
                            //关闭当前frame
                            parent.layer.close(index);
                            parent.location.reload(true);
                        });
                    }
                }
            )
            return false;

        });

        //遍历select option
        $(document).ready(function(){
            $("#pid-select option").each(function (text){
                var level = $(this).attr('data-level');
                var text = $(this).text();
                if(level>0){
                    text = "├　"+ text;
                    for(var i=0;i<level;i++){
                        text ="　　"+ text;　//js中连续显示多个空格，需要使用全角的空格
                        //console.log(i+"text:"+text);
                    }
                }
                $(this).text(text);

            });

            form.render('select'); //刷新select选择框渲染
        });

    });
</script>
@endsection
