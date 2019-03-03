<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Member;
use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Shop;
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
            $totalCost += $cart->amount * $cart->goods_price;
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
}
