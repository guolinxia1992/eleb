@extends('layout.template')
@section('contents')
<table class="table table-striped" style="text-align: center;background: white;margin-top: 500px;">
    <tr>
        <td>序号</td>
        <td>用户姓名</td>
        <td>邮箱</td>
        <td>密码</td>
        <td>账号状态</td>
        <td>操作</td>
    </tr>
        <tr>
            <td>{{auth()->user()->id}}</td>
            <td>{{auth()->user()->name}}</td>
            <td>{{auth()->user()->email}}</td>
            <td>{{auth()->user()->password}}</td>
            <td>{{auth()->user()->status==1?'正常':'禁用'}}</td>
            <td>
                {{--<a href="{{route('users.show',[$user])}}"><button class="btn btn-info">查看</button></a>--}}
                <a href="{{route('users.edit',[auth()->user()])}}"><button class="btn btn-primary">编辑</button></a>
                <form action="{{route('users.destroy',[auth()->user()])}}" method="post" style="display: inline;">
                    {{csrf_field()}}
                    {{method_field('delete')}}
                    <button class="btn btn-danger">删除</button>
                </form>
            </td>
        </tr>
</table>
    {{--{{$users->links()}}--}}
@stop