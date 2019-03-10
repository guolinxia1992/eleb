<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    //管理员列表
    public function index()
    {
        //读取数据
        $admins = Admin::all();
        return view('admin.index',compact('admins'));
    }
    //添加管理员
    public function create()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.create',compact('roles','permissions'));
    }

    public function store(Request $request)
    {
        //接收数据验证,有错返回提示
        $this->validate($request,
            ['name'=>'required','password'=>'required','email'=>'required|email'],
            [   'name.required'=>'请输入用户名',
                'password.required'=>'请输入密码',
                'email.required'=>'请输入邮箱',
                'email.email'=>'邮箱格式不正确',
                ]);
        //数据无误,保存
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->password = Hash::make($request->password);
        $admin->email = $request->email;
        $admin->remember_token = uniqid();
        $admin->save();
        $admin->syncRoles($request->role);
        $admin->syncPermissions($request->permission);
        return redirect()->route('admins.index')->with('success','管理员添加成功');
    }

    public function login()
    {
        //跳转登录界面
        return view('admin.login');
    }

    public function checkLogin(Request $request)
    {
        /*
         * 登录之前，需要修改两个配置
         * 1.config/auth.php->providers.users  'model' => \App\Models\Admin::class,
         * 2.Admin模型需要修改，继承 Illuminate\Notifications\Notifiable;
         */
        //接收数据验证,有错返回提示
//        $a = Auth::attempt([
//            'password'=>$request->password,
//        ]);
////        $hash = Hash::check($request->password,$a->password);
//        var_dump( $a);
//        var_dump(Auth::attempt([
//            'name'=>$request->name,
//            'password'=>$request->password,
//        ]));exit;

        $this->validate($request,
            ['name'=>'required','password'=>'required'],
            [   'name.required'=>'请输入用户名',
                'password.required'=>'请输入密码',
            ]);
        //数据无误,保存
        if (Auth::attempt([
            'name'=>$request->name,
            'password'=>$request->password,
        ])){
            //验证成功,保存信息到session
//            return view('layout.app')->with('success','登录成功');
            return redirect()->intended(route('home'))->with('success','登录成功');
        }else{
            return back()->with('danger','账号或密码不正确');
        }
//        return redirect()->intended(route('home'))->with('success','登录成功');
    }
    public function changePwd()
    {
        //跳转登录界面
        return view('admin.changePwd');
    }
    public function saveNewPwd(Admin $admin,Request $request)
    {
        /*
         * 登录之前，需要修改两个配置
         * 1.config/auth.php->providers.users  'model' => \App\Models\Admin::class,
         * 2.Admin模型需要修改，继承 Illuminate\Notifications\Notifiable;
         */
        //接收数据验证,有错返回提示
        $this->validate($request,
            ['password'=>'required','newpassword'=>'required','newpassword1'=>'required|same:newpassword'],
            [   'password.required'=>'请输入旧密码',
                'newpassword.required'=>'请输新密码',
                'newpassword1.same'=>'两次密码不一致',
                'newpassword1.required'=>'请确认新密码',
            ]);
        //数据无误,保存
        if (Hash::check($request->password,\auth()->user()->password)){
            //验证成功,保存信息到session
//            var_dump(auth()->user()->id);exit;
//            return view('layout.app')->with('success','登录成功');
            auth()->user()->update([
                'password'=>Hash::make($request->newpassword),
            ]);
//            Admin::alert('修改成功,请重新登录',"route('logout')");
//            session()->flash('success','修改成功,请重新登录');
            return redirect()->intended(route('login'))->with('success','密码修改成功,请重新登录');
        }else{
            return back()->with('danger','旧密码不正确');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success','您已安全退出');
    }
    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('admins.index')->with('success','删除成功');
    }
    public function edit(Admin $admin)
    {
        $roles = Role::all();
        //加载页面
        return view('admin.edit',compact('admin','roles'));
    }

    public function update(Admin $admin,Request $request)
    {
        //接收数据验证表单,有误返回提示
        $this->validate($request,
            ['name'=>'required','password'=>'required','email'=>'required|email'],
            [   'name.required'=>'请输入用户名',
                'password.required'=>'请输入密码',
                'email.required'=>'请输入邮箱',
                'email.email'=>'邮箱格式不正确',
            ]);
        //数据无误,保存
//        dd($request->role);
//        $role = new Role();
//        $role->name = $request->role;
//        $role->save();
        $admin->syncRoles($request->role);
        $admin->update(['name'=>$request->name,
            'password'=>Hash::make($request->password),
            'email'=>$request->email,
        ]);
        return redirect()->route('admins.index')->with('success','管理员修改成功');
    }
}
