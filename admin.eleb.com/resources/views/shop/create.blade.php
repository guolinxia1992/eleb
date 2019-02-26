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
    <form class="layui-form" method="post" action="{{route('shops.store')}}" enctype="multipart/form-data">
        <div class="layui-form-item">
            <label for="L_email" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>商家分类
            </label>
            <div class="layui-input-inline">
                <select name="shop_category_id" id="">
                    @foreach($shopcategories as $shopcategory)

                    <option value="{{$shopcategory->id}}">{{$shopcategory->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>商家名称
            </label>
            <div class="layui-input-inline">
                <input type="text" id="" name="shop_name" required="" lay-verify=""
                       autocomplete="off" class="layui-input">
            </div>
        </div>


        <!-- 编辑器容器 -->
        <script id="container" name="content" type="text/plain"></script>
        <div class="layui-form-item" >
            <label for="L_pass" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>图片
            </label>
            <div class="layui-input-inline">
                <input type="file" id="" name="shop_img" required="" lay-verify=""
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>商家评分
            </label>
            <div class="layui-input-inline">
                <input type="text" id="" name="shop_rating" required="" lay-verify=""
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>是否品牌
            </label>
            <div class="layui-input-inline">
                <select name="brand" id="">
                    <option value="1">是</option>
                    <option value="0">否</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>是否准时送达
            </label>
            <div class="layui-input-inline">
                <select name="on_time" id="">
                    <option value="1">是</option>
                    <option value="0">否</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>是否蜂鸟
            </label>
            <div class="layui-input-inline">
                <select name="fengniao" id="">
                    <option value="1">是</option>
                    <option value="0">否</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>是否保标记
            </label>
            <div class="layui-input-inline">
                <select name="bao" id="">
                    <option value="1">是</option>
                    <option value="0">否</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>是否票标记
            </label>
            <div class="layui-input-inline">
                <select name="piao" id="">
                    <option value="1">是</option>
                    <option value="0">否</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>是否准标记
            </label>
            <div class="layui-input-inline">
                <select name="zhun" id="">
                    <option value="1">是</option>
                    <option value="0">否</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>起送价格
            </label>
            <div class="layui-input-inline">
                <input type="text" id="" name="start_send" required="" lay-verify=""
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>配送费
            </label>
            <div class="layui-input-inline">
                <input type="text" id="" name="send_cost" required="" lay-verify=""
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>商家公告
            </label>
            <div class="layui-input-inline">
                <textarea name="notice" id="" cols="30" rows="10">

                </textarea>
            @include('vendor.ueditor.assets')
            <!-- 实例化编辑器 -->
                <script type="text/javascript">
                    var ue = UE.getEditor('container');
                    ue.ready(function() {
                        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
                    });
                </script>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>折扣信息
            </label>
            <div class="layui-input-inline">
                <input type="text" id="L_username" name="discount" required="" lay-verify="nikename"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>商家状态
            </label>
            <div class="layui-input-inline">
                <select name="status" id="">
                    <option value="0">待审核</option>
                    <option value="1">正常</option>
                    <option value="-1">禁用</option>
                </select>
            </div>
        </div>
        {{csrf_field()}}
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label" style="width: 120px;">
            </label>
            <button  class="layui-btn" lay-filter="" lay-submit="" type="submit" >
                确认添加
            </button>
        </div>
    </form>
</div>
@include('layout._footer')