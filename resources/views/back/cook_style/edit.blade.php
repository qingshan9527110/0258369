@extends('back.layouts.index')

@section('title','修改分类')

@section('content')
    <div class="weadmin-body">

        <form id="form1" class="layui-form">
            <div class="layui-tab">
                <ul class="layui-tab-title">
                    <li class="layui-this">基本设置</li>
                    {{--<li>栏目简介</li>--}}
                </ul>
                <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show">
                        <!--tab1 content-->
                        <div class="layui-form-item">
                            <label class="layui-form-label">父级分类</label>
                            <div class="layui-input-inline">
                                <select name="pid" id="pid-select" lay-verify="required" lay-filter="pid-select">
                                    <option value="0" data-level="0">顶级分类</option>
                                    @foreach ($list as $row)
                                        <option
                                            @if ($info->pid==$row->id)
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
                                <input type="text" name="name" lay-verify="required" jq-error="请输入分类名称" placeholder="请输入分类名称" autocomplete="off" class="layui-input" value="{{$info->name}}">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">排序</label>
                            <div class="layui-input-inline">
                                <input type="text" name="order" lay-verify="number" value="{{$info->order}}" jq-error="排序必须为数字" placeholder="分类排序" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">状态</label>
                            <div class="layui-input-inline">
                                <input type="radio" name="status" title="启用" value="0"
                                    @if($info->status==0)
                                    checked
                                    @endif
                                />
                                <input type="radio" name="status" title="禁用" value="1"
                                    @if($info->status==1)
                                    checked
                                    @endif
                                />
                            </div>
                        </div>
                        <!--//tab1 content-->
                    </div>

                    {{--<div class="layui-tab-item">--}}
                        {{--<!--tab3 content-->--}}
                        {{--<textarea id="topicBody" style="display: none;"></textarea>--}}
                        {{--<!--//tab3 content-->--}}
                    {{--</div>--}}

                </div>
            </div>

            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" id="editTopic" lay-submit="" lay-filter="add">立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('addjs')
    <script>
        layui.use(['admins', 'jquery', 'element', 'upload', 'form', 'layer', 'layedit'], function() {

            var admins = layui.admins,
                $ = layui.jquery,
                element = layui.element,
                upload = layui.upload,
                form = layui.form,
                layer = layui.layer,
                layedit = layui.layedit;
            //图片上传
            //上传缩略图，设定文件大小限制
            upload.render({
                elem: '#topicImg',
                url: '/upload/',
                size: 500 //限制文件大小，单位 KB
                ,
                done: function(res) {
                    console.log(res)
                }
            });
            //选择文件，栏目模板
            upload.render({
                elem: '#topicModelBtn',
                url: '/upload/',
                auto: false,
                accept: 'file'
                //,multiple: true
                ,
                bindAction: '#editTopic',
                choose: function(res) {
                    //var files = res.pushFile();
                    //预读本地文件，如果是多文件，则会遍历。(不支持ie8/9)
                    res.preview(function(index, file, result) {
                        //console.log(index); //得到文件索引
                        //console.log(file); //得到文件对象
                        //console.log(result); //得到文件base64编码，比如图片
                        $('input[name=topicModel]').val(file.name);
                        //console.log($('input[name=topicModel]').val())

                    });
                }
            });

            //layedit.build('topicBody'); //建立编辑器

            //监听提交
            form.on('submit(add)', function(data) {
                console.log(data.field);
                //发异步，把数据提交给php
                $.ajax({
                    url: "/back/cookStyle/{{$info->id}}",
                    type: "PUT",
                    data: data.field,
                    dataType: "json",
                    success: function (res) {
                        console.log(res)
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
                })

                return false;
            });

            //遍历select option
            $(document).ready(function() {
                $("#pid-select option").each(function(text) {

                    var level = $(this).attr('data-level');
                    var text = $(this).text();
                    //console.log(text);
                    if(level > 0) {
                        text = "├　" + text;
                        for(var i = 0; i < level; i++) {
                            text = "　　" + text;　 //js中连续显示多个空格，需要使用全角的空格
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
