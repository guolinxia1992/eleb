<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    {{--<meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />--}}
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
    <meta charset="UTF-8">
    <title>后台登录</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="./css/font.css">
    <link rel="stylesheet" href="./css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="./lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="./js/xadmin.js"></script>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
</head>
<body class="login-bg">

<div class="login layui-anim layui-anim-up">
    <div class="message">用户登录</div>
    <div id="darkbannerwrap"></div>
    @if(count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>
                        {{$error}}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    @foreach(['success','info','warning','danger'] as $status)
        @if(session()->has($status))
            <div class="alert alert-{{ $status }} alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ session($status) }}
            </div>
        @endif
    @endforeach
    <form method="post" class="layui-form" action="{{'login'}}">
        <input name="name" placeholder="用户名"  type="text" lay-verify="required" class="layui-input" >
        <hr class="hr15">
        <input name="password" lay-verify="required" placeholder="密码"  type="password" class="layui-input">
        <hr class="hr15">
        <div class="layui-form-item">
            <input type="text"  name="captcha" required="" lay-verify="nikename"
                   autocomplete="off" class="layui-input" placeholder="验证码">
            <div style="height: 10px">
                <div style="float: left;margin: 8px 0;">
                    <a href="" style="color: blue;">忘记密码?</a>
                </div>
                <div style="float:right;margin: 8px 0;">
                    <a href="" style="color: blue;">立即注册</a>
                </div>
            </div>
            <div style="width:100%;margin-top: 15px;">
                <div style="height: 10px"></div>
                <img class="thumbnail captcha" src="{{ captcha_src('default') }}" onclick="this.src='/captcha/default?'+Math.random()" title="点击图片重新获取验证码">
            </div>
            </div>
        {{csrf_field()}}
        <input value="登录"  style="width:100%;" type="submit">
        <hr class="hr20" >
    </form>
</div>

{{--<script>--}}
    {{--$(function  () {--}}
        {{--layui.use('form', function(){--}}
            {{--var form = layui.form;--}}
            {{--// layer.msg('玩命卖萌中', function(){--}}
            {{--//   //关闭后的操作--}}
            {{--//   });--}}
            {{--//监听提交--}}
            {{--form.on('submit(login)', function(data){--}}
                {{--// alert(888)--}}
                {{--layer.msg(JSON.stringify(data.field),function(){--}}
                    {{--location.href='index.html'--}}
                {{--});--}}
                {{--return false;--}}
            {{--});--}}
        {{--});--}}
    {{--})--}}


{{--</script>--}}


<!-- 底部结束 -->
<script>
    //百度统计可去掉
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script>
@include('layout._footer')