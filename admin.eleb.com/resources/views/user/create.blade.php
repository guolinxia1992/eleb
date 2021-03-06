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
    <form class="layui-form" method="post" action="{{route('users.store')}}" enctype="multipart/form-data">
        <div class="layui-form-item">
            <label for="L_email" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>账号
            </label>
            <div class="layui-input-inline">
                <input type="text" id="" name="name" required="" lay-verify=""
                       autocomplete="off" class="layui-input" value="{{old('name')}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_email" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>邮箱
            </label>
            <div class="layui-input-inline">
                <input type="text" id="" name="email" required="" lay-verify=""
                       autocomplete="off" class="layui-input" value="{{old('email')}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_email" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>密码
            </label>
            <div class="layui-input-inline">
                <input type="password" id="" name="password" required="" lay-verify=""
                       autocomplete="off" class="layui-input">
            </div>
        </div>
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
                       autocomplete="off" class="layui-input" value="{{old('shop_name')}}">
            </div>
        </div>
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
                <span class="x-red">*</span>是否品牌
            </label>
            <div class="layui-input-inline">
                <select name="brand" id="">
                    <option value="1" @if(old('brand')==1)selected @endif>是</option>
                    <option value="0" @if(old('brand')==0)selected @endif>否</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>是否准时送达
            </label>
            <div class="layui-input-inline">
                <select name="on_time" id="">
                    <option value="1" @if(old('on_time')==1)selected @endif >是</option>
                    <option value="0" @if(old('on_time')==0)selected @endif >否</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>是否蜂鸟
            </label>
            <div class="layui-input-inline">
                <select name="fengniao" id="">
                    <option value="1" @if(old('fengniao')==1)selected @endif>是</option>
                    <option value="0" @if(old('fengniao')==0)selected @endif>否</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>是否保标记
            </label>
            <div class="layui-input-inline">
                <select name="bao" id="">
                    <option value="1" @if(old('bao')==1)selected @endif>是</option>
                    <option value="0" @if(old('bao')==0)selected @endif>否</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>是否票标记
            </label>
            <div class="layui-input-inline">
                <select name="piao" id="">
                    <option value="1" @if(old('piao')==1)selected @endif>是</option>
                    <option value="0" @if(old('piao')==0)selected @endif>否</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>是否准标记
            </label>
            <div class="layui-input-inline">
                <select name="zhun" id="">
                    <option value="1" @if(old('zhun')==1)selected @endif>是</option>
                    <option value="0" @if(old('zhun')==0)selected @endif>否</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>起送价格
            </label>
            <div class="layui-input-inline">
                <input type="text" id="" name="start_send" required="" lay-verify=""
                       autocomplete="off" class="layui-input" value="{{old('start_send')}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>配送费
            </label>
            <div class="layui-input-inline">
                <input type="text" id="" name="send_cost" required="" lay-verify=""
                       autocomplete="off" class="layui-input" value="{{old('send_cost')}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>商家公告
            </label>
            <div class="layui-input-inline">
                <textarea name="notice" id="" cols="30" rows="10">{{old('notice')}}</textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>折扣信息
            </label>
            <div class="layui-input-inline">
                <input type="text" id="L_username" name="discount" required="" lay-verify="nikename"
                       autocomplete="off" class="layui-input" value="{{old('discount')}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>验证码
            </label>
            <div class="layui-input-inline">
                <input type="text" id="L_username" name="captcha" required="" lay-verify="nikename"
                       autocomplete="off" class="layui-input">
                <img class="thumbnail captcha" src="{{ captcha_src('default') }}" onclick="this.src='/captcha/default?'+Math.random()" title="点击图片重新获取验证码">
            </div>
        </div>
        {{csrf_field()}}
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label" style="width: 120px;">
            </label>
            <button  class="layui-btn" lay-filter="" lay-submit="" type="submit" >
                立即注册
            </button>
        </div>
    </form>
</div>
@include('layout._footer')