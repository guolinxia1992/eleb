
@extends('layout.template')
@section('contents')
    <form method="post" action="{{route('users.update',[$user])}}" enctype="multipart/form-data">
        <div class="form-group">
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
            <label for="exampleInputEmail1">用户名</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="请输入用户名" name="name" value="{{$user->name}}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">用户年龄</label>
            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="请输入年龄" name="age" value="{{$user->age}}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">用户头像</label>
            <input type="file" class="form-control" id="exampleInputPassword1"  name="img" >
            <img src="{{ $user->img()}}" alt="" style="width: 150px;">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">验证码</label>
            <input id="captcha" class="form-control" name="captcha" style="width: 130px;">
            <img class="thumbnail captcha" src="{{ captcha_src('default') }}" onclick="this.src='/captcha/default?'+Math.random()" title="点击图片重新获取验证码">
        </div>
        {{csrf_field()}}
        {{method_field('patch')}}
        <button type="submit" class="btn btn-success">确认添加</button>
    </form>
@stop