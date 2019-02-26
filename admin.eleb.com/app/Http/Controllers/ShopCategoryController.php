<?php

namespace App\Http\Controllers;

use App\Models\ShopCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShopCategoryController extends Controller
{
    //显示商品分类列表
    public function index()
    {
        //获取分类全部数据
        $shopcategories = ShopCategory::paginate(3);
        //显示分类数据页面
        return view('shopcategory.index',compact('shopcategories'));
    }

    public function create()
    {
        //显示添加分类页面
        return view('shopcategory.create');
    }

    public function store(Request $request)
    {
        //接收数据,验证,有误返回提示错误
//        $this->validate($request,
//            ['name'=>'required','img'=>'required'],
//            ['name.required'=>'请输入分类名称','img.required'=>'请上传图片']);
//        //数据无误保存
//        $img = $request->img;
//        var_dump($img);
//        $path = $img->store('public/shopcategory');
        ShopCategory::create(['name'=>$request->name,'img'=>$request->img,'status'=>$request->status]);
        //数据写入session
        session()->flash('success','分类添加成功');
        //跳转首页
        return redirect()->route('shopcategories.index');
    }

    public function destroy(ShopCategory $shopcategory)
    {
        //删除数据
        $shopcategory->delete();
        //跳转页面
        return redirect()->route('shopcategories.index');
    }

    public function edit(ShopCategory $shopcategory)
    {
        //显示修改页面
        return view('shopcategory.edit',compact('shopcategory'));
    }

    public function update(Request $request,ShopCategory $shopcategory)
    {
        //接收数据,验证,有误返回提示错误
        $this->validate($request,
            ['name'=>'required','img'=>'image'],
            ['name.required'=>'请输入分类名称','img.image'=>'图片格式有误']);
        //数据无误保存
        $img = $request->file('img');
        if($img){
            $path = $img->store('public/shopcategory');
        }else{
            $path = '';
        }
        $shopcategory->update(['name'=>$request->name,'img'=>$path,'status'=>$request->status]);
        //写入session
        session()->flash('success','修改成功');
        //跳转页面
        return redirect()->route('shopcategories.index');
    }

    public function show(ShopCategory $shopcategory)
    {
        //传值显示页面
        return view('shopcategory.show',compact('shopcategory'));
    }

    public function upload(Request $request)
    {
        $img = $request->file('file');
        $path = url(Storage::url($img->store('public/shopcategory')));
        return ['path'=>$path];
    }
}
