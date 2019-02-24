<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuCategoryController extends Controller
{
    public function __construct()
    {
        //设置权限
        $this->middleware('auth',[
            'except'=>'login'
        ]);
    }
    //显示菜品列表
    public function index()
    {
        $menucategories = MenuCategory::all();
        return view('menucategory.index',compact('menucategories'));
    }

    public function create(MenuCategory $menucategory)
    {
        return view('menucategory.create',compact('menucategory'));
    }

    public function store(Request $request)
    {
        //验证数据,有误返回并提示
        $this->validate($request,
            [
                'name'=>'required',
                'description'=>'required',
                'is_selected'=>'required',
            ],
            [
                'name.required'=>'请输入菜品分类名称',
                'description.required'=>'请填写菜品描述',
                'is_selected.required'=>'请选择是否为默认分类',
            ]);
        //数据无误,保存到数据库

        $str = str_shuffle('qwertyuiopasdfghjklzxcvbnm');
        $code = substr($str, 0, 1);
        $menucategory = new MenuCategory();
        if($request->is_selected==1){
            DB::table('menu_categories')->update(['is_selected'=>0]);
        }
        $menucategory->name = $request->name;
//        $menucategory->type_accumulation =range("a","z",[rand(0,25)]);
        $menucategory->type_accumulation =$code;
        $menucategory->shop_id = auth()->user()->id;
        $menucategory->description = $request->description;
        $menucategory->is_selected = $request->is_selected;
//        dd( $menucategory->type_accumulation);
        $menucategory->save();
        return redirect()->route('menucategories.index')->with('success','菜品分类添加成功');
    }

    public function destroy(MenuCategory $menucategory)
    {
        //删除数据
        $data = Menu::query()->where('category_id',$menucategory->id)->get();
//        var_dump(count($data));exit;
        if(count($data)){
            return back()->with('danger','该分类有下属菜品,无法删除');
        }else{
            $menucategory->delete();
            return redirect()->route('menucategories.index')->with('success','删除成功');
        }

    }

    public function edit(MenuCategory $menucategory)
    {
        //调用视图
        return view('menucategory.edit',compact('menucategory'));
    }

    public function update(MenuCategory $menucategory,Request $request)
    {
        //验证数据,有误返回并提示
        $this->validate($request,
            [
                'name'=>'required',
                'description'=>'required',
                'is_selected'=>'required',
            ],
            [
                'name.required'=>'请输入菜品分类名称',
                'description.required'=>'请填写菜品描述',
                'is_selected.required'=>'请选择是否为默认分类',
            ]);
        //数据无误,保存到数据库
        if($request->is_selected==1){
            DB::table('menu_categories')->update(['is_selected'=>0]);
        }
        $menucategory->update(['name'=>$request->name,'description'=>$request->description,'is_selected'=>$request->is_selected]);
        return redirect()->route('menucategories.index')->with('success','修改成功');
    }
}
