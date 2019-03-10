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
    <form class="layui-form" method="post" action="{{route('admins.store')}}" enctype="multipart/form-data">
        <div class="layui-form-item">
            <label for="" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>账号
            </label>
            <div class="layui-input-inline">
                <input type="text" id="" name="name" required="" lay-verify=""
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item" >
            <label for="L_pass" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>邮箱
            </label>
            <div class="layui-input-inline">
                <input type="text" id="" name="email" required="" lay-verify=""
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>密码
            </label>
            <div class="layui-input-inline">
                <input type="password" id="" name="password" required="" lay-verify=""
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>所属角色
            </label>
            <div class="layui-input-inline">
                @foreach($roles as $role)
                    <input type="checkbox"  name="role[]"  autocomplete="off" class="" value="{{$role->name}}" >{{$role->name}}
                @endforeach
            </div>
        </div>
        <div class="layui-form-item">
            <label for="" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>权限
            </label>
            <div class="layui-input-inline">
                @foreach($permissions as $permission)
                    <input type="checkbox"  name="permission[]"   class="" value="{{$permission->id}}" >{{$permission->name}}
                @endforeach
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