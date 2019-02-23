<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\ShopCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    //显示商家列表
    public function index()
    {
        //获取商家全部数据
        $shops = Shop::all();
        //显示商家数据页面
        return view('shop.index',compact('shops'));
    }

    public function create()
    {
        //获取商家分类信息
        $shopcategories = ShopCategory::all();
        //显示添加分类页面
        return view('shop.create',compact('shopcategories'));
    }

    public function store(Request $request)
    {
//        dd($request);
        //接收数据,验证,有误返回提示错误
        $this->validate($request,
            [
                'shop_category_id'=>'required|integer',
                'shop_name'=>'required',
                'shop_img'=>'required|image',
                'brand'=>'required',
                'on_time'=>'required',
                'fengniao'=>'required',
                'bao'=>'required',
                'piao'=>'required',
                'zhun'=>'required',
                'start_send'=>'required',
                'send_cost'=>'required',
                'notice'=>'required',
                'discount'=>'required',
                'status'=>'required',
            ],
            [
                'shop_category_id.required'=>'请输入商家分类id',
                'shop_category_id.integer'=>'商家分类id只能是整数',
                'shop_name.required'=>'请输入商家名称',
                'shop_img.required'=>'请上传图片',
                'shop_img.image'=>'图片格式有误',
                'brand.required'=>'请选择是否是品牌',
                'fengniao.required'=>'请选择是否蜂鸟配送',
                'zhun.required'=>'请选择是否准标记',
                'start_send.required'=>'请输入起送金额',
                'send_cost.required'=>'请输入配送金额',
                'notice.required'=>'请输入店公告',
                'discount.required'=>'请输入优惠信息',
                'status.required'=>'请选择状态',
            ]);
        //数据无误保存
        $img = $request->file('shop_img');
//        var_dump($request);exit;
        $path = $img->store('public/shop');
//        $path = $img->store('public/shop');
        $shop = new Shop();
        $shop->shop_category_id = $request->shop_category_id;
        $shop->shop_name = $request->shop_name;
        $shop->shop_img = url(Storage::url($path));
        $shop->brand = $request->brand;
        $shop->on_time = $request->on_time;
        $shop->shop_rating = rand(1,5);
        $shop->fengniao = $request->fengniao;
        $shop->bao = $request->bao;
        $shop->piao = $request->piao;
        $shop->zhun = $request->zhun;
        $shop->start_send = $request->start_send;
        $shop->send_cost = $request->send_cost;
        $shop->notice = $request->notice;
        $shop->discount = $request->discount;
        $shop->status = $request->status;
        $shop->save();
        //数据写入session
        session()->flash('success','商家添加成功');
        //跳转首页
        return redirect()->route('shops.index');
    }

    public function destroy(Shop $shop)
    {
        //删除数据
        $shop->delete();
        //跳转页面
        return redirect()->route('shops.index');
    }

    public function edit(Shop $shop)
    {
        //显示修改页面
        $shopcategories = ShopCategory::all();
        return view('shop.edit',compact('shop','shopcategories'));
    }

    public function update(Request $request,Shop $shop)
    {
        //接收数据验证,有误返回并提示
        $this->validate($request,
        [
            'shop_category_id'=>'required|integer',
            'shop_name'=>'required',
            'shop_img'=>'image',
            'brand'=>'required',
            'on_time'=>'required',
            'fengniao'=>'required',
            'bao'=>'required',
            'piao'=>'required',
            'zhun'=>'required',
            'start_send'=>'required',
            'send_cost'=>'required',
            'notice'=>'required',
            'discount'=>'required',
            'status'=>'required',
        ],
            [
                'shop_category_id.required'=>'请输入商家分类id',
                'shop_category_id.integer'=>'商家分类id只能是整数',
                'shop_name.required'=>'请输入商家名称',
                'shop_img.required'=>'请上传图片',
                'shop_img.image'=>'图片格式有误',
                'brand.required'=>'请选择是否是品牌',
                'fengniao.required'=>'请选择是否蜂鸟配送',
                'zhun.required'=>'请选择是否准标记',
                'start_send.required'=>'请输入起送金额',
                'send_cost.required'=>'请输入配送金额',
                'notice.required'=>'请输入店公告',
                'discount.required'=>'请输入优惠信息',
                'status.required'=>'请选择状态',
            ]);
        //数据无误保存
        $img = $request->file('shop_img');
//        var_dump($request);exit;
        if($img){
            $path = $img->store('public/shop');
        }else{
            $path = '';
        }
//        $path = $img->store('public/shop');
        //数据无误,保存
        $shop->update([
        'shop_category_id' => $request->shop_category_id,
        'shop_name' => $request->shop_name,
        'shop_img' => url(Storage::url($path)),
        'brand' => $request->brand,
        'on_time' => $request->on_time,
        'shop_rating' => rand(1,5),
        'fengniao' => $request->fengniao,
        'bao' => $request->bao,
        'piao' => $request->piao,
        'zhun' => $request->zhun,
        'start_send' => $request->start_send,
        'send_cost' => $request->send_cost,
        'notice' => $request->notice,
        'discount' => $request->discount,
        'status' => $request->status]);
        //写入session
        session()->flash('success','修改成功');
        //跳转页面
        return redirect()->route('shops.index');
    }

    public function show(Shop $shop)
    {
        //传值显示页面
        return view('shop.show',compact('shop'));
    }

    public function checkShop(Shop $shop)
    {
        //
    }
}
