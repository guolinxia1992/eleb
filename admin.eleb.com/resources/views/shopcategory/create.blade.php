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
                <select name="status" id="">
                    <option value="1">显示</option>
                    <option value="0">隐藏</option>
                </select>
                {{--<input type="text" id="L_username" name="username" required="" lay-verify="nikename"--}}
                       {{--autocomplete="off" class="layui-input">--}}
            </div>
        </div>
        <div class="layui-form-item" >
            <label for="L_pass" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>图片
            </label>
            <div class="layui-input-inline">
                <input type="file" id="L_pass" name="img" required="" lay-verify="pass"
                       autocomplete="off" class="layui-input">
            </div>

        </div>
        {{csrf_field()}}
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label" style="width: 120px;">
            </label>
            <button  class="layui-btn" lay-filter="add" lay-submit="">
                确认添加
            </button>
        </div>
    </form>
</div>
@include('layout._footer')