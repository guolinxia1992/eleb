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
    <form class="layui-form" method="post" action="{{route('navs.update',[$nav])}}" enctype="multipart/form-data">
        <div class="layui-form-item">
            <label for="" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>名称
            </label>
            <div class="layui-input-inline">
                <input type="text" id="" name="name" required="" lay-verify=""
                       autocomplete="off" class="layui-input" value="{{$nav->name}}">
            </div>
        </div>
        <div class="layui-form-item" >
            <label for="L_pass" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>上级菜单
            </label>
            <div class="layui-input-inline">
                <select name="pid" >
                    <option value="0" @if($nav->pid==0)selected @endif>顶级菜单</option>
                        @foreach($topnavs as $topnav)
                        <option value="{{$topnav->id}}" @if($nav->pid==$topnav->id)selected @endif>{{$topnav->name}}</option>

                        @endforeach
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label" style="width: 120px;">
                地址
            </label>
            <div >
                <input type="text"  name="url"  class="layui-input" style="width: 190px;" value="{{$nav->url}}">
            </div>
        </div>
        <div class="layui-form-item" @if(0==$nav->pid) style="display: none;" @endif>
            <label for="L_username" class="layui-form-label" style="width: 120px;">
                权限
            </label>
            <div class="layui-input-inline">
                <select name="permission" id="">
                    @if(0==$nav->permission_id)
                        <option value="0" >无权限</option>
                    @endif
                    @foreach($permissions as $permission)
                        <option value="{{$permission->id}}" @if($permission->id==$nav->permission_id)selected @endif>{{$permission->name}}</option>
                    @endforeach
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