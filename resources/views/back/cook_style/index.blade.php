@extends('back.layouts.index')

@section('title','分类列表')

@section('content')

<div class="weadmin-nav">
			<span class="layui-breadcrumb">
		        <a href="">首页</a>
		        <a href="">文章管理</a>
		        <a><cite>分类管理</cite></a>
		    </span>
    <a class="layui-btn layui-btn-sm" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="weadmin-body">
    <div class="weadmin-block">
        <button class="layui-btn" id="expand">全部展开</button>
        <button class="layui-btn" id="collapse">全部收起</button>
        <button class="layui-btn" onclick="WeAdminShow('添加分类','{{route("back.cookStyle.create")}}')"><i class="layui-icon"></i>添加</button>
        <span class="fr" style="line-height:40px">共有数据：66 条</span>
    </div>

    <div id="demo"></div>
</div>

@endsection

@section('addjs')
<script>

    function del(nodeId) {
        var data = {_mothod:'DELETE',id:nodeId};
        layer.confirm('确定要删除吗？', function(index) {
            $.ajax({
                url: "{{route('back.cookStyle.desc')}}",
                type: "DELETE",
                data: data,
                dataType: "json",
                success: function (res) {
                    console.log(res)
                    if(res.code == 0){
                        layer.msg('已删除!', {
                            icon: 5,
                            time: 1000
                        });
                        setTimeout(function () {
                            window.location.reload(true);
                        },1500)

                    }else{
                        layer.msg(res.msg, {
                            icon: 6,
                            time: 1000
                        });
                    }
                }
            })
        });
    }
    /*分类-停用*/
    function changeStatus(obj, id) {
        var confirmTip;
        if($(obj).attr('title') == '启用') {
            confirmTip = '确认要停用吗？';
        } else {
            confirmTip = '确认要启用吗？';
        }
        layer.confirm(confirmTip, function(index) {
            if($(obj).attr('title') == '启用') {
                //发异步把用户状态进行更改
                $.post("{{route('api.cookStyle.changeStatus')}}",
                    {
                        'id' : id
                    },
                    function (res) {
                        if(res){
                            $(obj).attr('title', '停用')
                            $(obj).find('i').html('&#xe62f;');
                            $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
                            layer.msg('已停用!', {
                                icon: 5,
                                time: 1000
                            });
                        }else{
                            layer.msg('系统错误!', {
                                icon: 6,
                                time: 1000
                            });
                        }
                    }
                )

            } else {
                //发异步把用户状态进行更改
                $.post("{{route('api.cookStyle.changeStatus')}}",
                    {
                        'id' : id
                    },
                    function (res) {
                        if(res){
                            $(obj).attr('title', '启用')
                            $(obj).find('i').html('&#xe601;');

                            $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
                            layer.msg('已启用!', {
                                icon: 6,
                                time: 1000
                            });
                        }else{
                            layer.msg('系统错误!', {
                                icon: 6,
                                time: 1000
                            });
                        }
                    }
                )

            }
        });
    }
    //自定义的render渲染输出多列表格
    var layout = [{
        name: '菜单名称',
        treeNodes: true,
        headerClass: 'value_col',
        colClass: 'value_col',
        style: 'width: 60%'
    },
        {
            name: '状态',
            headerClass: 'td-status',
            colClass: 'td-status',
            style: 'width: 10%',
            render: function(row) {
                if(row.status==0){
                    return '<span class="layui-btn layui-btn-normal layui-btn-xs">已启用</span>';
                }else{
                    return '<span class="layui-btn layui-btn-normal layui-btn-xs layui-btn-disabled">已停用</span>';
                }
            }
        },
        {
            name: '操作',
            headerClass: 'td-manage',
            colClass: 'td-manage',
            style: 'width: 20%',
            render: function(row) {
                var title = "启用";
                if(row.status==1){
                    title = "停用";
                }
                var url_edit = '/back/cookStyle/'+row.id+'/edit';
                var url_create = '/back/cookStyle/'+row.id;
                return '<a onclick="changeStatus(this,'+row.id+')" href="javascript:;" title="'+title+'"><i class="layui-icon">&#xe601;</i></a>' +
                    '<a title="添加子类" onclick="WeAdminShow(\'添加\',\''+url_create+'\')" href="javascript:;"><i class="layui-icon">&#xe654;</i></a>' +
                    '<a title="编辑" onclick="WeAdminShow(\'编辑\',\''+url_edit+'\')" href="javascript:;"><i class="layui-icon">&#xe642;</i></a>' +
                    '<a title="删除" onclick="del(' + row.id + ')" href="javascript:;">\<i class="layui-icon">&#xe640;</i></a>';
                //return '<a class="layui-btn layui-btn-danger layui-btn-mini" onclick="del(' + row.id + ')"><i class="layui-icon">&#xe640;</i> 删除</a>'; //列渲染
            }
        },
    ];
    //加载扩展模块 treeGird
    //		layui.config({
    //			  base: './static/js/'
    //			  ,version: '101100'
    //			}).use('admin');
    layui.use(['treeGird', 'admins', 'layer'], function() {
        var layer = layui.layer,
            admins = layui.admins,
            treeGird = layui.treeGird;


        $.post("{{route('api.cookStyle.getList')}}",{},function (res) {
            var tree1 = layui.treeGird({
                elem: '#demo', //传入元素选择器
                spreadable: true, //设置是否全展开，默认不展开
                nodes: res,
                // nodes: [{
                //     "id": "1",
                //     "name": "父节点1",
                //     "children": [{
                //         "id": "11",
                //         "name": "子节点11"
                //     },
                //         {
                //             "id": "12",
                //             "name": "子节点12"
                //         }
                //     ]
                // },
                //     {
                //         "id": "2",
                //         "name": "父节点2",
                //         "children": [{
                //             "id": "21",
                //             "name": "子节点21",
                //             "children": [{
                //                 "id": "211",
                //                 "name": "子节点211"
                //             }]
                //         }]
                //     }
                // ],
                layout: layout
            });
        });


        $('#collapse').on('click', function() {
            layui.collapse(tree1);
        });

        $('#expand').on('click', function() {
            layui.expand(tree1);
        });
    });


</script>
@endsection
