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
</head>
<body>