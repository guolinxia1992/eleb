@include('layout._header')

<div class="x-body layui-anim layui-anim-up" >
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
    <form class="layui-form" method="post" action="{{route('shopcategories.store')}}" enctype="multipart/form-data">
        <div class="layui-form-item">
            <label for="L_email" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>分类名称
            </label>
            <div class="layui-input-inline">
                <input type="text" id="L_name" name="name" required="" lay-verify=""
                       autocomplete="off" class="layui-input" >
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>分类状态
            </label>
            <div class="layui-input-inline">
                <select name="status" >
                    <option value="1">显示</option>
                    <option value="0">隐藏</option>
                </select>
                {{--<input type="text" id="L_username" name="username" required="" lay-verify="nikename"--}}
                       {{--autocomplete="off" class="layui-input">--}}
            </div>
        </div>
        <!--引入CSS-->
        <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">

        <!--引入JS-->
        <script type="text/javascript" src="/webuploader/webuploader.js"></script>
        <!--dom结构部分-->

        <div class="layui-form-item" >
            <label for="L_pass" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>图片
            </label>
            <input type="hidden" name="img" id="img_val">
            <div id="uploader-demo">
                <!--用来存放item-->
                <div id="fileList" class="uploader-list"></div>
                <div id="filePicker">选择图片</div>
            </div>
            <img src="" alt="" id="img">
        </div>
        {{csrf_field()}}
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label" style="width: 120px;">
            </label>
            <button  class="layui-btn" type="submit">
                确认添加
            </button>
        </div>
    </form>
</div>
<script>
    var uploader = WebUploader.create({
        // 选完文件后，是否自动上传。
        auto: true,
        // swf文件路径
        //swf: '/js/Uploader.swf',
        // 文件接收服务端。
        server: '/upload',
        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: '#filePicker',
        // 只允许选择图片文件。
        accept: {
            title: 'Images',
            extensions: 'gif,jpg,jpeg,bmp,png',
            mimeTypes: 'image/*'
        },
        //设置上传请求参数
        formData:{
            _token:'{{ csrf_token()}}'
        }
    });

    uploader.on( 'uploadSuccess', function( file,response ) {
        // do some things.
        //图片回显
        console.log(response.path);
        $("#img").attr('src',response.path);
        //图片地址写入隐藏域
        $("#img_val").val(response.path);
    });
</script>
@include('layout._footer')