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
    <form class="layui-form" method="post" action="{{route('menus.store')}}" enctype="multipart/form-data">
        <div class="layui-form-item">
            <label for="" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>菜品名称
            </label>
            <div class="layui-input-inline">
                <input type="text" id="" name="goods_name" required="" lay-verify=""
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>所属商家
            </label>
            <div class="layui-input-inline">
                <input type="text" id="" name="shop_id" required="" lay-verify=""
                       autocomplete="off" class="layui-input" value="{{auth()->user()->name}}" disabled="true">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>所属分类
            </label>
            <div class="layui-input-inline">
                <select name="category_id" id="">
                    @foreach($menucategories as $menucategory)
                    <option value="{{$menucategory->id}}">{{$menucategory->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>价格
            </label>
            <div class="layui-input-inline">
                <input type="text" id="" name="goods_price" required="" lay-verify=""
                       autocomplete="off" class="layui-input" placeholder="">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>描述
            </label>
            <div class="layui-input-inline">
                <textarea name="description" id="" cols="30" rows="10" style="width: 190px;"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>提示信息
            </label>
            <div class="layui-input-inline">
                <textarea name="tips" id="" cols="30" rows="10" style="width: 190px;"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>菜品图片
            </label>
            <div class="layui-input-inline">
                <input type="file" id="" name="goods_img" required="" lay-verify=""
                       autocomplete="off" class="layui-input" placeholder="">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>菜品状态
            </label>
            <div class="layui-input-inline">
                <select name="status" id="">
                    <option value="1">上架</option>
                    <option value="0">下架</option>
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