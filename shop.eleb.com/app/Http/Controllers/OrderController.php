<?php

namespace App\Http\Controllers;

use App\Models\Helpers\DateHelper;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //显示订单列表
    public function index()
    {
        $orders = Order::where('shop_id','=',auth()->user()->shop_id)->get();
        return view('order.index',compact('orders'));
    }
    //查看详情
    public function show(Order $order)
    {
        $orderdetails = OrderDetail::where('order_id','=',$order->id)->get();
        return view('order.show',compact('orderdetails'));
    }

    public function accept(Order $order)
    {
        $order->update(['status'=>2]);
        return redirect()->route('orders.index')->with('success','发货成功');
    }
    public function cancel(Order $order)
    {
        $order->update(['status'=>-1]);
        return redirect()->route('orders.index')->with('success','取消成功');
    }
    //查询一周的订单
    public function orderLook(Request $request)
    {
        $keyword = $request->keyword;
        $datas = [];
        $count = '';
        if($keyword=='week'){
            for($i=0;$i<7;$i++){
                $date = date('Y-m-d',strtotime("-$i day"));
                $order = Order::where('created_at','like',"%$date%")->where('shop_id','=',auth()->user()->shop_id)->get();
//            var_dump($date);
                $count += count($order);
                $datas += [$date=>count($order)];
            }
        }
        if($keyword=='threemonth'){
            for($i=0;$i<3;$i++){
                $date = date('Y-m',strtotime("-$i month"));
                $order = Order::where('created_at','like',"%$date%")->where('shop_id','=',auth()->user()->shop_id)->get();
//            var_dump($date);
                $count += count($order);
                $datas += [$date=>count($order)];
            }
        }
        return view('order.orderLook',compact('datas','keyword','count'));
    }

    public function menuLook(Request $request)
    {
        $keyword = $request->keyword??'week';
//        echo '<pre>';
        $shop_id = auth()->user()->shop_id;
//        dump($shop_id);
        if($keyword == 'week'){
            $start_time = date('Y-m-d 00:00:00',strtotime('-6 day'));
            $end_time = date('Y-m-d 23:59:59');
        }elseif($keyword == 'threemonth'){
            $start_time = date('Y-m-d 00:00:00',strtotime('-2 month'));
            $end_time = date('Y-m-d 23:59:59');
        }
//        var_dump($end_time);
        $sql = "SELECT DATE(orders.created_at) AS date,order_details.goods_id,order_details.goods_name As goods_name,
	            SUM(order_details.amount) AS total
                FROM order_details
                JOIN orders ON order_details.order_id = orders.id
                WHERE orders.created_at >= '{$start_time}' AND orders.created_at <= '{$end_time}' AND shop_id = {$shop_id}
                GROUP BY DATE(orders.created_at),order_details.goods_id,goods_name";
        $rows = DB::select($sql);
        if($keyword == 'week'){
            $week = [];
            for($i=0;$i<7;$i++){
                $week[] = date('Y-m-d',strtotime("-$i day"));
            }
        }elseif($keyword == 'threemonth'){
            $month = [];
            for($i=0;$i<3;$i++){
                $month[] = date('Y-m',strtotime("-$i month"));
            }
        }
        $menus = Menu::where('shop_id',$shop_id)->select(['id','goods_name'])->get()->toArray();
        $data = [];
        $result = [];
        foreach($menus as $menu){
            if($keyword == 'week'){
                foreach($week as $day){
                    $result[$menu['goods_name']][$day]=0;
                }
            }elseif($keyword == 'threemonth'){
                foreach($month as $m){
                    $result[$menu['goods_name']][$m]=0;
                }
            }
            $data[] = $menu;
        }
//        dd($result);
        foreach($rows as $row){
            if($keyword == 'week'){
                $result[$row->goods_name][$row->date]=$row->total;
            }elseif($keyword == 'threemonth'){
                $time = strtotime($row->date);
                $date = date("Y-m",$time);
                $result[$row->goods_name][$date]+=$row->total;
            }

        }

        $series = [];
        foreach ($result as $k=>$v){
            $serie = [
                'name'=> $k,
                'type'=>'bar',
                //'stack'=> '销量',
                'data'=>array_values($v)
            ];
            $series[] = $serie;
        }
//        var_dump($series);exit;
        return view('order.menuLook',compact('result','menus','week','series','keyword','month'));
    }
}
