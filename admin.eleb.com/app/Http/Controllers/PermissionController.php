<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('permission.index',compact('permissions'));
    }
    //创建权限
    public function create()
    {
        return view('permission.create');
    }
    //保存权限
    public function store(Request $request)
    {
        //接收数据存储
        $permission = Permission::create(['name' => $request->name]);
        return redirect()->route('permissions.index')->with('succcess','添加成功');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permissions.index')->with('succcess','删除成功');
    }
    public function edit(Permission $permission)
    {
        return view('permission.edit',compact('permission'));
    }

    public function update(Permission $permission,Request $request)
    {
        //接收数据
        $permission->update(['name'=>$request->name]);
        return redirect()->route('permissions.index')->with('succcess','修改成功');
    }
}
