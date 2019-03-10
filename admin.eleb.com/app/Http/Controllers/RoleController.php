<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('role.index',compact('roles'));
    }
    //创建角色
    public function create()
    {
        $permissions = Permission::all();
        return view('role.create',compact('permissions'));
    }
    //保存权限
    public function store(Request $request)
    {
        $permissions = $request->permission;
//        dd($permissions);
        //接收数据存储
        $role = new Role();
        $role->name = $request->name;
        $role->save();
        $role->syncPermissions($permissions);
        return redirect()->route('roles.index')->with('succcess','添加成功');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('succcess','删除成功');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('role.edit',compact('role','permissions'));
    }

    public function update(Role $role,Request $request)
    {
        //接收数据
        $role->update(['name'=>$request->name]);
//        var_dump($request->permission);exit;
        $role->syncPermissions($request->permission);
        return redirect()->route('roles.index')->with('succcess','修改成功');
    }
}
