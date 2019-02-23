@extends('layout.template')
@section('contents')
    <table class="table table-striped">
        <tr>
            <td>序号</td>
            <td>商品名称</td>
            <td>商品价格</td>
            <td>商品分类</td>
            <td>商品详情</td>
            <td>是否上架</td>
            <td>浏览次数</td>
            {{--<td>操作</td>--}}
        </tr>
        <tr>
            <td>{{$good->id}}</td>
            <td>{{$good->name}}</td>
            <td>{{$good->price}}</td>
            <td>{{$good->goodscategory->name}}</td>
            <td>{{$good->detail}}</td>
            <td>{{$good->is_onsale}}</td>
            <td>{{$good->b_times}}</td>
            {{--<td>--}}
                {{--<a href="{{route('goods.show',[$good])}}"><button class="btn btn-info">查看</button></a>--}}
                {{--<a href="{{route('goods.edit',[$good])}}"><button class="btn btn-primary">编辑</button></a>--}}
                {{--<form action="{{route('goods.destroy',[$good])}}" method="post" style="display: inline;">--}}
                    {{--{{csrf_field()}}--}}
                    {{--{{method_field('delete')}}--}}
                    {{--<button class="btn btn-danger">删除</button>--}}
                {{--</form>--}}
            {{--</td>--}}
        </tr>
    </table>
@stop