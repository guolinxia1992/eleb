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
    <form class="layui-form" method="post" action="{{route('navs.store')}}" enctype="multipart/form-data">
        <div class="layui-form-item">
            <label for="" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>名称
            </label>
            <div class="layui-input-inline">
                <input type="text" id="" name="name" required="" lay-verify=""
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item" >
            <label for="L_pass" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>上级菜单
            </label>
            <div class="layui-input-inline">
                <select name="pid" id="">
                    <option value="0">顶级分类</option>
                        @foreach($navs as $nav)
                        <option value="{{$nav->id}}">{{$nav->name}}</option>
                        @endforeach
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label" style="width: 120px;">
                地址
            </label>
            <div >
                <input type="text"  name="url"  class="layui-input" style="width: 190px;">
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