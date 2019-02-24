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
    <form class="layui-form" method="post" action="{{route('menucategories.update',[$menucategory])}}" enctype="multipart/form-data">
        <div class="layui-form-item">
            <label for="" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>菜品分类名称
            </label>
            <div class="layui-input-inline">
                <input type="text" id="" name="name" required="" lay-verify=""
                       autocomplete="off" class="layui-input" value="{{$menucategory->name}}">
            </div>
        </div>
        <div class="layui-form-item" >
            <label for="L_pass" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>菜品编号
            </label>
            <div class="layui-input-inline">
                <input type="text" id="" name="type_accumulation" required="" lay-verify=""
                       autocomplete="off" class="layui-input" placeholder="a-z字母" value="{{$menucategory->type_accumulation}}">
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
                <span class="x-red">*</span>描述
            </label>
            <div class="layui-input-inline">
                <textarea name="description" id="" cols="30" rows="10" style="width: 190px;">{{$menucategory->description}}</textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>是否默认菜品
            </label>
            <div class="layui-input-inline">
                <select name="is_selected" id="">
                    <option value="1" @if($menucategory->is_selected==1)selected @endif>是</option>
                    <option value="0" @if($menucategory->is_selected==0)selected @endif>否</option>
                </select>
            </div>
        </div>
        {{csrf_field()}}
        {{method_field('patch')}}
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label" style="width: 120px;">
            </label>
            <button  class="layui-btn" lay-filter="" lay-submit="" type="submit" >
                确认修改
            </button>
        </div>
    </form>
</div>
@include('layout._footer')