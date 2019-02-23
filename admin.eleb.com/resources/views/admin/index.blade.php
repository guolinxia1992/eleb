@include('layout._header')
<div class="x-body">
    <div class="layui-row">
        <form class="layui-form layui-col-md12 x-so">
            <input type="text" name="username"  placeholder="请输入用户名" autocomplete="off" class="layui-input">
            <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </form>
    </div>
    <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <a href="{{route('admins.create')}}" class="layui-btn" ><i class="layui-icon"></i>添加</a>
        <span class="x-right" style="line-height:40px">共有数据：{{count($admins)}} 条</span>
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
            <td>管理员账号</td>
            <td>邮箱</td>
            <td>密码</td>
            <td>操作</td>
        </tr>
        @foreach($admins as $admin)
            <tr>
                <td>
                    <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
                </td>
                <td>{{$admin->id}}</td>
                <td>{{$admin->name}}</td>
                <td>{{$admin->email}}</td>
                <td>{{$admin->password}}</td>
                <td class="td-manage">
                    <a title="编辑" href="{{route('admins.edit',[$admin])}}">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    <form action="{{route('admins.destroy',[$admin])}}" method="post" style="display: inline;">
                        {{csrf_field()}}
                        {{method_field('delete')}}
                        <button title="删除" style="outline: none;border: none;background: none;"><span class="glyphicon glyphicon-trash"></span></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    <div class="page">
        <div>
            {{--{{$admins->links()}}--}}
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