@extends('back.layouts.index')

@section('title','管理员删除')

@section('content')
    <div class="weadmin-nav">
        <span class="layui-breadcrumb">
    <a href="">首页</a>
    <a href="">会员管理</a>
    <a>
      <cite>删除会员</cite></a>
  </span>
        <a class="layui-btn layui-btn-sm" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
            <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="weadmin-body">
        <div class="layui-row">
            <form class="layui-form layui-col-md12 we-search">
                会员搜索：
                <div class="layui-inline">
                    <input class="layui-input" placeholder="开始日" name="start" id="start">
                </div>
                <div class="layui-inline">
                    <input class="layui-input" placeholder="截止日" name="end" id="end">
                </div>
                <div class="layui-inline">
                    <input type="text" name="username" placeholder="请输入用户名" autocomplete="off" class="layui-input">
                </div>
                <button class="layui-btn" lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
            </form>
        </div>
        <div class="weadmin-block">
            <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon">&#xe640;</i>批量恢复</button>
            <span class="fr" style="line-height:40px">共有数据：88 条</span>
        </div>
        <table class="layui-table">
            <thead>
            <tr>
                <th>
                    <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
                </th>
                <th>ID</th>
                <th>用户名</th>
                <th>性别</th>
                <th>手机</th>
                <th>邮箱</th>
                <th>地址</th>
                <th>加入时间</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
                </td>
                <td>1</td>
                <td>小明</td>
                <td>男</td>
                <td>13000000000</td>
                <td>admin@mail.com</td>
                <td>北京市 海淀区</td>
                <td>2017-01-01 11:11:42</td>
                <td class="td-status">
                        <span class="layui-btn layui-btn-danger layui-btn-xs">
                            已删除
                        </span>
                <td class="td-manage">
                    <a title="恢复" onclick="member_del(this,'要删除的id')" href="javascript:;">
                        <i class="layui-icon">&#xe618;</i>
                    </a>
                    <a title="删除" onclick="member_del(this,'要删除的id')" href="javascript:;">
                        <i class="layui-icon">&#xe640;</i>
                    </a>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
                </td>
                <td>1</td>
                <td>小明</td>
                <td>男</td>
                <td>13000000000</td>
                <td>admin@mail.com</td>
                <td>北京市 海淀区</td>
                <td>2017-01-01 11:11:42</td>
                <td class="td-status">
                        <span class="layui-btn layui-btn-danger layui-btn-xs">
                            已删除
                        </span>
                <td class="td-manage">
                    <a title="恢复" onclick="member_del(this,'要删除的id')" href="javascript:;">
                        <i class="layui-icon">&#xe618;</i>
                    </a>
                    <a title="删除" onclick="member_del(this,'要删除的id')" href="javascript:;">
                        <i class="layui-icon">&#xe640;</i>
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="page">
            <div>
                <a class="prev" href="">&lt;&lt;</a>
                <a class="num" href="">1</a>
                <span class="current">2</span>
                <a class="num" href="">3</a>
                <a class="num" href="">489</a>
                <a class="next" href="">&gt;&gt;</a>
            </div>
        </div>

    </div>

@endsection

@section('addjs')

@endsection
