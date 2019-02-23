<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>后台管理</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    {{--<meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />--}}
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
    <link rel="shortcut icon" href={{ URL::asset("/favicon.ico")}} type="image/x-icon" />
    <link rel="stylesheet" href="{{ URL::asset('css/font.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/xadmin.css') }}">
    <script type="text/javascript" src="{{ URL::asset('https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('lib/layui/layui.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/xadmin.js') }}"></script>
{{--<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />--}}
{{--<link rel="stylesheet" href="./css/font.css">--}}
{{--<link rel="stylesheet" href="./css/xadmin.css">--}}
{{--<script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>--}}
{{--<script type="text/javascript" src="./lib/layui/layui.js" charset="utf-8"></script>--}}
{{--<script type="text/javascript" src="./js/xadmin.js"></script>--}}
<!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]> -->
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
<div class="logo"><a href="./index.html">饿了吧商家平台</a></div>
<div class="left_open">
    <i title="展开左侧栏" class="iconfont">&#xe699;</i>

</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="z-index: 9999;">
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
</div>
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="z-index: 9999;">
    <div class="login layui-anim layui-anim-up">
        <div class="message">修改密码</div>
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
        <form class="layui-form" method="post"  enctype="multipart/form-data" action="{{route('saveNewPwd')}}">
            <div class="layui-form-item">
                <label for="" class="layui-form-label" style="width: 120px;">
                    <span class="x-red">*</span>旧密码
                </label>
                <div class="layui-input-inline">
                    <input type="password"  name="password" required="" lay-verify=""
                           autocomplete="off" class="layui-input" >
                </div>
            </div>
            <div class="layui-form-item" >
                <label for="L_pass" class="layui-form-label" style="width: 120px;">
                    <span class="x-red">*</span>新密码
                </label>
                <div class="layui-input-inline">
                    <input type="password" id="" name="newpassword" required="" lay-verify=""
                           autocomplete="off" class="layui-input" >
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_username" class="layui-form-label" style="width: 120px;">
                    <span class="x-red">*</span>确认新密码
                </label>
                <div class="layui-input-inline">
                    <input type="password" id="" name="newpassword1" required="" lay-verify=""
                           autocomplete="off" class="layui-input" >
                </div>
            </div>
            {{csrf_field()}}
            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label" style="width: 120px;">
                </label>
                <button  class="layui-btn" lay-filter="" lay-submit="" type="submit" >
                    确认修改
                </button>
            </div>
        </form>
    </div>
</div>
<ul class="layui-nav left fast-add" lay-filter="">
    <li class="layui-nav-item">
        <a href="javascript:;" style="text-decoration: none;">+新增</a>
        <dl class="layui-nav-child"> <!-- 二级菜单 -->
            <dd><a onclick="x_admin_show('资讯','http://www.baidu.com')" style="text-decoration: none;height: 30px;line-height: 30px;"><i class="iconfont">&#xe6a2;</i>资讯</a></dd>
            <dd><a onclick="x_admin_show('图片','http://www.baidu.com')" style="text-decoration: none;height: 30px;line-height: 30px;"><i class="iconfont">&#xe6a8;</i>图片</a></dd>
            <dd><a onclick='x_admin_show("修改密码","{{route('logout',[auth()->user()])}}")' style="text-decoration: none;height: 30px;line-height: 30px;"><i class="iconfont">&#xe6b8;</i>用户</a></dd>
        </dl>
    </li>
</ul>
<ul class="layui-nav right" lay-filter="" >
    <!-- Modal -->


    @guest
        <li class="layui-nav-item" ><a style="text-decoration: none;" data-toggle="modal" data-target="#myModal">登录</a></li>
    @endguest
    @auth
        <li class="layui-nav-item">
            <a href="javascript:;" style="text-decoration: none;">欢迎您!{{auth()->user()->name}}</a>
            <dl class="layui-nav-child"> <!-- 二级菜单 -->
                <dd><a onclick="x_admin_show('个人信息','http://www.baidu.com')" style="text-decoration: none;height: 30px;line-height: 30px;">个人信息</a></dd>
                <dd><a data-toggle="modal" data-target="#myModal1" style="text-decoration: none;height: 30px;line-height: 30px;">修改密码</a></dd>
                <dd><a href="{{route('logout')}}" style="text-decoration: none;height: 30px;line-height: 30px;">退出</a></dd>
            </dl>
        </li>
    @endauth
    <li class="layui-nav-item to-index"><a href="/" style="text-decoration: none;">前台首页</a></li>
</ul>