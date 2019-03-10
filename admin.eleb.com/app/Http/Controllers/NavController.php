<?php

namespace App\Http\Controllers;

use App\Models\Nav;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class NavController extends Controller
{
    //导航列表
    public function index()
    {
        //读取数据
        $navs = Nav::paginate(5);

        $topnavs = Nav::where('pid','=',0)->get();
//        var_dump($topnavs);exit;
        return view('nav.index',compact('navs','topnavs'));
    }
//    public function nav()
//    {
//        //读取数据
//        $topnavs = Nav::where('pid','=',0)->get();
//        $navs = Nav::where('pid','<>',0)->get();
//        dd($topnavs);
//        return view('layout._left',compact('navs','topnavs'));
//    }
    //添加管理员
    public function create()
    {
        $navs = Nav::where('pid','=',0)->get();
        $permissions = Permission::all();
        return view('nav.create',compact('navs','permissions'));
    }

    public function store(Request $request)
    {
        //接收数据验证,有错返回提示
        $this->validate($request,
            ['name'=>'required','pid'=>'required'],
            [   'name.required'=>'请输入菜单名',
                'pid.required'=>'请选择层级',
            ]);
        //数据无误,保存
        $nav = new Nav();
        $nav->name = $request->name;
        $nav->url = $request->url;
        $nav->pid = $request->pid;
        $nav->save();
        return redirect()->route('navs.index')->with('success','菜单添加成功');
    }

    public function destroy(Nav $nav)
    {
        $nav->delete();
        return redirect()->route('navs.index')->with('success','菜单删除成功');
    }

    public function edit(Nav $nav)
    {
//        $topnavs = Nav::all();
        $topnavs = Nav::where('pid','=',0)->get();
//        var_dump($topnavs);exit;
        $permissions = Permission::all();
        return view('nav.edit',compact('topnavs','nav','permissions'));
    }
    public function update(Nav $nav,Request $request)
    {
        //接收数据验证表单,有误返回提示
        $this->validate($request,
            ['name'=>'required','pid'=>'required'],
            [   'name.required'=>'请输入菜单名',
                'pid.required'=>'请选择层级',
            ]);
//        dd($request);
        $nav->update(['name'=>$request->name,
            'url'=>$request->url,
            $nav->pid = $request->pid
        ]);
        return redirect()->route('navs.index')->with('success','菜单修改成功');
    }
}
