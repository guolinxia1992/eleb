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
            @foreach(['success','info','warning','danger'] as $status)
                @if(session()->has($status))
                    <div class="alert alert-{{ $status }} alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {{ session($status) }}
                    </div>
                @endif
            @endforeach
    <form class="layui-form" method="post" action="{{route('saveNewPwd',[auth()->user()])}}" enctype="multipart/form-data">
        <div class="layui-form-item">
            <label for="" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>旧密码
            </label>
            <div class="layui-input-inline">
                <input type="password"  name="password"
                       autocomplete="off" class="layui-input" >
            </div>
        </div>
        <div class="layui-form-item" >
            <label for="L_pass" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>新密码
            </label>
            <div class="layui-input-inline">
                <input type="password"  name="newpassword"
                       autocomplete="off" class="layui-input" >
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>确认新密码
            </label>
            <div class="layui-input-inline">
                <input type="password"  name="newpassword1"
                       autocomplete="off" class="layui-input" >
            </div>
        </div>
        {{csrf_field()}}
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label" style="width: 120px;">
            </label>
            <button  class="layui-btn" type="submit" >
                确认修改
            </button>
        </div>
    </form>
</div>
@include('layout._footer')