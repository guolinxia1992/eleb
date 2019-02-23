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
    <form class="layui-form" method="post" action="{{route('users.update',[$user])}}" enctype="multipart/form-data">
        <div class="layui-form-item">
            <label for="L_email" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>账号
            </label>
            <div class="layui-input-inline">
                <input type="text" id="" name="name" required="" lay-verify=""
                       autocomplete="off" class="layui-input" value="{{$user->name}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_email" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>邮箱
            </label>
            <div class="layui-input-inline">
                <input type="text" id="" name="email" required="" lay-verify=""
                       autocomplete="off" class="layui-input" value="{{$user->email}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_email" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>密码
            </label>
            <div class="layui-input-inline">
                <input type="password" id="" name="password" required="" lay-verify=""
                       autocomplete="off" class="layui-input" value="{{$user->password}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_email" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>商家状态
            </label>
            <div class="layui-input-inline">
                <select name="status" id="">
                    <option value="1" @if($user->status==1)selected @endif>启用</option>
                    <option value="0" @if($user->status==0)selected @endif>禁用</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_email" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>所属商户id
            </label>
            <div class="layui-input-inline">
                <input type="text" id="" name="shop_id" required="" lay-verify=""
                       autocomplete="off" class="layui-input" value="{{$user->shop_id}}">
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