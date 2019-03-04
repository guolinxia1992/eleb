<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Member;
use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Shop;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Qcloud\Sms\SmsSingleSender;
use Validator;
class ApiController extends Controller
{
    //商家列表
    public function businessList(Request $request)
    {
        $keyword = $request->keyword;
        if($keyword){
            $shop = Shop::where('status','=',1)->where('shop_name','like',"%$keyword%")->get();
        }else{
            $shop = Shop::where('status','=',1)->get();
        }
        return $shop;
    }
    public function business(Request $request)
    {
        $id = $request->id;
//        dd($id);
        $shops = Shop::find($id);
        $menucategories = MenuCategory::where('shop_id','=',$id)->get();
        $arr = [[
                "user_id"=> 12344,
                "username"=> "w******k",
                "user_img"=> "/images/slider-pic4.jpeg",
                "time"=> "2017-2-22",
                "evaluate_code"=> 5,
                "send_time"=> 30,
                "evaluate_details"=> "不怎么好吃"
            ]];
        foreach ($menucategories as $menucategory){
            $menucategory['goods_list'] = Menu::where('category_id','=',$menucategory->id)->get();
            foreach($menucategory['goods_list'] as $goods){
                $goods['goods_id'] = $goods->id;
            }
        }
        $shops['commodity'] = $menucategories;
        $shops['evaluate'] = $arr;
        return $shops;
    }
    public function regist(Request $request)
    {
        $capcha = Redis::get($request->tel);
        $a = Member::where('tel','=',$request->tel)->get();
        if(count($a)){
            return ['status'=>'false','message'=>'账号已存在'];
        }else{
            if($capcha == $request->sms){
                $tel = $request->tel;
                $member = new Member();
                $member->username = $request->username;
                $member->password = Hash::make($request->password);
                $member->remember_token = uniqid();
                $member->tel = $tel;
                $member->save();
                return ['status'=>'true','message'=>'注册成功'];
            }else{
                return ['status'=>'false','message'=>'验证码错误'];
            }
        }
    }
    public function sms(Request $request){
        // 短信应用SDK AppID
        $tel = $request->tel;
        $appid = 1400188032; // 1400开头
        // 短信应用SDK AppKey
        $appkey = "e6037df72ed9bfe5604f0c8413445185";
        // 需要发送短信的手机号码
        $phoneNumber = $tel;
        // 短信模板ID，需要在短信应用中申请
        $templateId = 285369;  // NOTE: 这里的模板ID`7839`只是一个示例，真实的模板ID需要在短信控制台中申请
        $smsSign = "郭琳夏个人分享";
        try {
            $ssender = new SmsSingleSender($appid, $appkey);
            $params = [mt_rand(1000,9999),5];
            $result = $ssender->sendWithParam("86", $phoneNumber, $templateId,
                $params, $smsSign, "", "");  // 签名参数未提供或者为空时，会使用默认签名发送短信
            Redis::set($tel,$params[0],300);
            return ["status"=> "true","message"=> "获取短信验证码成功"];
        } catch(\Exception $e) {
            var_dump($e);
        }
    }

    public function checkLogin(Request $request)
    {
        //接收数据验证
//        return Hash::check('123',$request->password);
        if(Auth::attempt(['username'=>$request->name,
            'password'=>$request->password])){
            return ["status"=>"true","message"=>"登录成功","user_id"=>\auth()->user()->id,"username"=>$request->username];
        }else{
            return ["status"=>"false","message"=>"账号或密码错误"];
        }
    }

    public function addressList()
    {
        $address = Address::where('user_id','=',\auth()->user()->id)->get();
        return $address;
    }
    public function address(Request $request)
    {
        $address = Address::find($request->id);
//        var_dump($address);exit;
        $address['provence'] = $address->province;
        $address['area'] = $address->county;
        $address['detail_address'] = $address->address;
//        dd($address);
        return $address;
    }
    public function editAddress(Request $request)
    {
        Address::where('id','=',$request->id)->update(
            [
                'name'=>$request->name,
                'tel'=>$request->tel,
                'name'=>$request->name,
                'province'=>$request->provence,
                'city'=>$request->city,
                'county'=>$request->area,
                'address'=>$request->detail_address,
            ]
        );
        return ["status"=> "true","message"=>"修改成功"];
    }
    public function addAddress(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'address'=>'required',
            'username'=>'required'
        ]);
        //接收数据保存
//        dd(111);
        $addres = new Address();
        $addres->user_id = auth()->user()->id;
        $addres->province = $request->provence;
        $addres->city = $request->city;
        $addres->county = $request->area;
        $addres->address = $request->detail_address;
        $addres->tel = $request->tel;
        $addres->name = $request->name;
        $addres->is_default = 0;
        $addres->save();
        return [
            "status"=>"true",
            "message"=> "添加成功"
        ];
    }
    //订单接口
    public function cart()
    {
        $data = Cart::where('user_id','=',auth()->user()->id)->get();
        $totalCost =0;
        foreach( $data as $cart){
            $goods = Menu::find($cart->goods_id);
            $cart['goods_name'] = $goods->goods_name;
            $cart['goods_img'] = $goods->goods_img;
            $cart['goods_price'] = $goods->goods_price * $cart->amount;
            $totalCost += $cart['goods_price'];
        }
        $datar['goods_list']=$data;
        $datar['totalCost']=$totalCost;
        return $datar;
    }
//    public function cart(){
//        $cate = Cart::where('user_id','=',\auth()->user()->id)->get();
//        $totalCost =0;
//        foreach($cate as $a){
//            $data = Menu::find($a->goods_id);
//            $a['goods_name'] = $data->goods_name;
//            $a['goods_img'] = $data->goods_img;
//            $a['goods_price'] = $data->goods_price;
//            $totalCost += $a->amount * $a->goods_price;
//        }
//        $datar['goods_list']=$cate;
//        $datar['totalCost']=$totalCost;
//        return $datar;
//    }
    public function addCart(Request $request)
    {
        //接收数据
//        foreach($request->goodsList as $v){
//            foreach($request->goodsCount as $k){
//                $addcart = new Cart();
//                $addcart->user_id = \auth()->user()->id;
//                $addcart->goods_id = $v;
//                $addcart->amount = $k;
//                $addcart->save();
//            }
//            break;
//        }
        for($i=0;$i<count($request->goodsList);$i++){
            $addcart = new Cart();
            $addcart->user_id = \auth()->user()->id;
            $addcart->goods_id = $request->goodsList[$i];
            $addcart->amount = $request->goodsCount[$i];
            $addcart->save();
        }
        return ["status"=> "true","message"=> "添加成功"];
    }

    public function addOrder(Request $request)
    {
        //获取配送地址信息
        $address = Address::find($request->address_id);
        //获取一条菜品信息
//        var_dump($address->user_id);exit();

        //计算总价格
        $carts = Cart::where('user_id','=',$address->user_id)->get();
        //获取所属shop_id
        $total =0;
        foreach($carts as $cart){
            $shop = Menu::find($cart->goods_id);
            $total += $shop->goods_price * $cart->amount;
        }
        //获取所属shop_id
        $cart1 = Cart::where('user_id','=',$address->user_id)->get()->first();
//        var_dump($cart1);exit();
        $shopid = Menu::find($cart1->goods_id);
        DB::beginTransaction();
        try{
            $order = new Order();
            $order->shop_id = $shopid->shop_id;
            $order->user_id = auth()->user()->id;
            $order->sn = date('Ymd').mt_rand(10000,99999);
            $order->province = $address->province;
            $order->city = $address->city;
            $order->county = $address->county;
            $order->address = $address->address;
            $order->tel = $address->tel;
            $order->name = $address->name;
            $order->status = 1;
            $order->out_trade_no = uniqid();
            $order->total = $total;
            $order->save();
            foreach($carts as $cart){
                $shop = Menu::find($cart->goods_id);
                $total = $shop->goods_price * $cart->amount;
                $order_detail = new OrderDetail();
                $order_detail->goods_id = $cart->goods_id;
                $order_detail->amount = $cart->amount;
                $order_detail->goods_name = $shop->goods_name;
                $order_detail->goods_img = $shop->goods_img;
                $order_detail->goods_price = $total;
                $order_detail->order_id = $order->id;
                $order_detail->save();
            }
            DB::commit();
            return ["status"=> "true","message"=> "添加成功","order_id"=>1];
        }catch(QueryException $exception){
            DB::rollBack();
        }
    }

    public function order(Request $request)
    {
        $orders = Order::find($request->id);
//        var_dump($orders->id);exit();
        $order_detail = OrderDetail::where('order_id','=',$request->id)->get()->first();
        $details = OrderDetail::where('order_id','=',$request->id)->get();
//        $orders['goods_list'][] = [];
        foreach($details as $detail){
            $detail['goods_id'] = $detail->goods_id;
            $detail['goods_name'] = $detail->goods_name;
            $detail['goods_img'] = $detail->goods_img;
            $detail['amount'] = $detail->amount;
            $detail['goods_price'] = $detail->goods_price;
        }
        $menu = Menu::find($order_detail->goods_id);
        $shop = Shop::find($menu->shop_id);
        $orders['order_code'] = $orders['sn'];
        $time = $orders['created_at']->toArray();
        $orders['order_birth_time'] = $time['formatted'];
        $orders['order_status'] = $orders['status'];
        $orders['shop_id'] = $shop['id'];
        $orders['shop_name'] = $shop['shop_name'];
        $orders['shop_img'] = $shop['shop_img'];
        $orders['goods_list'] = $details;
        $orders['order_address'] = $orders['address'];
        return $orders;
    }

    public function orderList(Request $request)
    {
        $orders = Order::where('user_id','=',auth()->user()->id)->get();
        foreach($orders as $order){
            $order['order_code'] = $order->sn;
            $time = $order['created_at']->toArray();
            $order['order_birth_time'] = $time['formatted'];
            $order['order_status'] = $order->status;
            $shop = Shop::find($order->shop_id);
            $order['shop_id'] = $order->shop_id;
            $order['shop_name'] = $shop->shop_name;
            $order['shop_img'] = $shop->shop_img;
            $order['order_price'] = $order->total;
            $order['order_address'] = $order->address;
            $goods = OrderDetail::where('order_id','=',$order->id)->get();
            foreach($goods as $good){
                $good['goods_id'] = $good->goods_id;
            }
            $order['goods_list'] = $goods;
        }
        return $orders;
    }

    public function changePassword(Request $request)
    {
        //接收数据验证
        if(Hash::check($request->oldPassword,\auth()->user()->password)){
            Member::where('id','=',\auth()->user()->id)->update(['password'=>Hash::make($request->newPassword)]);
            return ["status"=>"true","message"=>"修改成功"];
        }else{
            return ["status"=>"false","message"=>"旧密码错误"];
        }
    }

    public function forgetPassword(Request $request)
    {
        $capcha = Redis::get($request->tel);
        $member = Member::where('tel','=',$request->tel)->get();
        if(count($member)<1){
            return ["status"=>"false","message"=>"该手机号不存在"];
        }else{
            if($capcha != $request->sms){
                return ["status"=>"false","message"=>"验证码错误"];
            }else{
                Member::where('tel','=',$request->tel)->update(['password'=>Hash::make($request->password)]);
                return ["status"=>"true","message"=>"重置成功"];
            }
        }
    }
}
