@include('layout._header')
<div class="x-body">
    <div class="layui-row">
        {{--<form class="layui-form layui-col-md12 x-so" method="get" action="{{route('orderdetails.index')}}">--}}
            {{--<input type="text" name="keywords"  placeholder="请输入菜品名称" autocomplete="off" class="layui-input">--}}
            {{--价格:<input type="text" name="price1"  placeholder="¥" autocomplete="off" class="layui-input" style="width: 50px;"><span class="glyphicon glyphicon-arrow-right"></span>--}}
            {{--<input type="text" name="price2"  placeholder="¥" autocomplete="off" class="layui-input" style="width: 50px;">--}}
            {{--<button type="submit" class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>--}}
        {{--</form>--}}
    </div>
    <xblock>
        {{--<button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>--}}
        <a href="{{route('orders.index')}}" class="layui-btn" >  <span class="glyphicon glyphicon-arrow-left"></span>返回 </a>
        <span class="x-right" style="line-height:40px">共有数据：{{count($orderdetails)}} 条</span>
        @foreach(['success','info','warning','danger'] as $status)
            @if(session()->has($status))
                <div class="alert alert-{{ $status }} alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ session($status) }}
                </div>
            @endif
        @endforeach
    </xblock>
    <table class="layui-table">
        <thead>
        <tr>
            <td></td>
            <td>编号</td>
            <td>菜品名称</td>
            <td>数量</td>
            <td>图片</td>
            <td>价格</td>
        </tr>
        @foreach($orderdetails as $orderdetail)
            <tr>
                <td>
                    <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
                </td>
                <td>{{$orderdetail->id}}</td>
                <td>{{$orderdetail->goods_name}}</td>
                <td>{{$orderdetail->amount}}</td>
                <td><img src="{{$orderdetail->goods_img}}" alt="图片加载失败" width="100px"></td>
                <td>{{$orderdetail->goods_price}}</td>

            </tr>
        @endforeach
    </table>

    <div class="page">
        <div>
            {{--{{$orderdetails->links()}}--}}
        </div>
    </div>

</div>
<script>
    layui.use('laydate', function(){
        var laydate = layui.laydate;

        //执行一个laydate实例
        laydate.render({
            elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
            elem: '#end' //指定元素
        });
    });

    /*用户-停用*/
    // function member_stop(obj,id){
    //     layer.confirm('确认要停用吗？',function(index){
    //
    //         if($(obj).attr('title')=='启用'){
    //
    //             //发异步把用户状态进行更改
    //             $(obj).attr('title','停用')
    //             $(obj).find('i').html('&#xe62f;');
    //
    //             $(obj).parents("tr").find(".td-status").find('p').addClass('layui-btn-disabled').html('已停用');
    //             layer.msg('已停用!',{icon: 5,time:1000});
    //
    //         }else{
    //             $(obj).attr('title','启用')
    //             $(obj).find('i').html('&#xe601;');
    //
    //             $(obj).parents("tr").find(".td-status").find('p').removeClass('layui-btn-disabled').html('已启用');
    //             layer.msg('已启用!',{icon: 5,time:1000});
    //         }
    //
    //     });
    // }

    /*用户-删除*/
    function member_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            //发异步删除数据
            $(obj).parents("tr").remove();
            layer.msg('已删除!',{icon:1,time:1000});
        });
    }



    function delAll (argument) {

        var data = tableCheck.getData();

        layer.confirm('确认要删除吗？'+data,function(index){
            //捉到所有被选中的，发异步进行删除
            layer.msg('删除成功', {icon: 1});
            $(".layui-form-checked").not('.header').parents('tr').remove();
        });
    }
</script>
<script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();</script>


@include('layout._footer')