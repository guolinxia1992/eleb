<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function __construct()
    {
        //设置权限
        $this->middleware('auth',[
            'except'=>'login'
        ]);
    }
    //显示菜品列表
    public function index(Request $request)
    {
        $keywords = $request->keywords;
        $price1 = $request->price1;
        $price2 = $request->price2;

        $wheres = [];
        if($keywords) $wheres[]=['goods_name','like',"%$keywords%"];
        if($price1) $wheres[] = ['goods_price','>=',$price1];
        if($price2) $wheres[] = ['goods_price','<=',$price2];
        /*if($price1 && $price2 && $keywords){
            $menus = Menu::where('goods_name','like',"%$keywords%")->whereBetween('goods_price',[$price1,$price2])->paginate(3);
        }elseif($keywords){
            $menus = Menu::where('goods_name','like',"%$keywords%")->paginate(3);
        }elseif($price1 && $price2){
            $menus = Menu::whereBetween('goods_price',[$price1,$price2])->paginate(3);
        }else{
            $menus = Menu::paginate(3);
        }*/
        $menus = Menu::where($wheres)->paginate(3);
        var_dump($menus);exit;
        return view('menu.index',compact('menus'));
    }

    public function create(Menu $menu)
    {
        $menucategories = MenuCategory::all();
        return view('menu.create',compact('menucategories'));
    }

    public function store(Request $request)
    {
        //验证数据,有误返回并提示
        $this->validate($request,
            [
                'goods_name'=>'required',
                'category_id'=>'required',
                'goods_price'=>'required',
                'description'=>'required',
                'tips'=>'required',
                'goods_img'=>'required|image',
                'status'=>'required',
            ],
            [
                'goods_name.required'=>'请输入菜品名称',
                'category_id.required'=>'请选择分类',
                'goods_price.required'=>'请输入价格',
                'description.required'=>'请输入描述',
                'tips.required'=>'请输入提示',
                'status.required'=>'请选择状态',
                'goods_img.required'=>'请上传图片',
                'goods_img.image'=>'图片格式有误',
            ]);
        //数据无误,保存到数据库
        //接收图片
//        var_dump($_POST);exit;
        $img = $request->file('goods_img');
        $path = Storage::url($img->store('public/menu'));
        $menu = new Menu();
        $menu->goods_name = $request->goods_name;
        $menu->rating = rand(1,5);
        $menu->shop_id = auth()->user()->id;
        $menu->category_id = $request->category_id;
        $menu->goods_price = $request->goods_price;
        $menu->description = $request->description;
        $menu->month_sales = rand(40,50);
        $menu->rating_count = rand(40,50);
        $menu->tips = $request->tips;
        $menu->satisfy_count = rand(40,50);
        $menu->satisfy_rate = rand(40,50);
        $menu->goods_img = url($path);
        $menu->status = $request->status;
        $menu->save();
        return redirect()->route('menus.index')->with('success','菜品添加成功');
    }

    public function destroy(Menu $menu)
    {
        //删除数据
        $menu->delete();
        return redirect()->route('menu.index')->with('success','删除成功');
    }

    public function edit(Menu $menu)
    {
        //调用视图
        $menucategories = MenuCategory::all();
        return view('menu.edit',compact('menu','menucategories'));
    }

    public function update(Menu $menu,Request $request)
    {
        //验证数据,有误返回并提示
        $this->validate($request,
            [
                'goods_name'=>'required',
                'category_id'=>'required',
                'description'=>'required',
                'goods_price'=>'required',
                'tips'=>'required',
                'goods_img'=>'image',
                'status'=>'required',
            ],
            [
                'goods_name.required'=>'请输入菜品名称',
                'category_id.required'=>'请选择分类',
                'goods_price.required'=>'请输入价格',
                'description.required'=>'请输入描述',
                'tips.required'=>'请输入提示',
                'status.required'=>'请选择状态',
                'goods_img.image'=>'图片格式有误',
            ]);
        //数据无误,保存到数据库
        //判断是否修改图片
        $img = $request->file('goods_img');
        if($img){
            $path = url(Storage::url($img->store('public/menu')));
        }else{
            $path = $menu->goods_img;
        }
        $menu->update(['goods_name'=>$request->goods_name,'description'=>$request->description,'goods_price'=>$request->goods_price,'tips'=>$request->tips,'goods_img'=>$path,'status'=>$request->status]);
        return redirect()->route('menus.index')->with('success','修改成功');
    }

    public function showDetail(MenuCategory $menucategory)
    {
        //接收数据
//        var_dump($menucategory);exit;
        $menus = Menu::where('category_id','=',$menucategory->id)->get();
        return view('menu.showDetail',compact('menus'));
    }
}
