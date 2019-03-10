@include('layout._header')
<div class="x-body">
    <div class="layui-row">
        <form action="{{route('orders.menuLook')}}" method="get">
            <select name="keyword" id=""  style="width: 155px;height: 40px;">
                <option value="week" @if($keyword=='week')selected @endif>近7天</option>
                <option value="threemonth" @if($keyword=='threemonth')selected @endif>近三个月</option>
            </select>
            <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </form>
    </div>
    <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>订单列表</button>
        {{--<span class="x-right" style="line-height:40px">共有数据：{{count($datas)}} 条</span>--}}
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
            <td>菜品</td>
            @if($keyword=='week')
                @foreach($week as $day)
                    <td>{{$day}}</td>
                @endforeach
            @elseif($keyword=='threemonth')
                @foreach($month as $m)
                    <td>{{$m}}</td>
                @endforeach
            @endif
            <td>总计</td>
        </tr>
        </thead>
        @foreach($result as $k=>$v)
        <tr>
            <td>{{$k}}</td>
            @foreach($v as $vv)
                <td>{{$vv}}</td>
            @endforeach
            <td>{{array_sum($v)}}</td>
        </tr>
        @endforeach
        {{--<tr>--}}
            {{----}}
            {{--<td>{{$count}}</td>--}}
        {{--</tr>--}}

    </table>

    <div class="page">
        <div>
            {{--{{$datas->links()}}--}}
        </div>
    </div>

</div>
<script src="https://cdn.bootcss.com/echarts/4.1.0-release/echarts.min.js"></script>
<!-- 为ECharts准备一个具备大小（宽高）的Dom -->
<div id="main" style="width: 1000px;height:400px;"></div>
<script type="text/javascript">
    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('main'));

    // 指定图表的配置项和数据
    var option = {
        tooltip : {
            trigger: 'axis',
            axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
            }
        },
        legend: {
            data:{!!json_encode(array_keys($result))!!}
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis : [
            {
                type : 'category',
                data : @if($keyword=='week'){!!json_encode(array_values($week))!!} @elseif($keyword=='threemonth'){!!json_encode(array_values($month))!!}@endif
            }
        ],
        yAxis : [
            {
                type : 'value'
            }
        ],
        series : {!!json_encode($series)!!}
    };
    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
</script>
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