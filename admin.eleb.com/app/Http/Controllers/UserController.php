<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\ShopCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //显示商家信息
    public function index()
    {
//        echo 111;exit;
        //获取所有商家信息
        $users = User::all();
        //调用视图显示
        return view('user.index',compact('users'));
    }

    public function create()
    {
        $shopcategories = ShopCategory::all();
        return view('user.create',compact('shopcategories'));
    }

    public function store(Request $request)
    {
        //验证表单,有误返回提示
        $this->validate($request,['name'=>'required','email'=>'required|email','password'=>'required','captcha'=>'required|captcha','img'=>'requires|image'],
            ['name.required'=>'请输入用户名',
                'email.required'=>'请输入邮箱',
                'email.email'=>'邮箱格式错误',
                'img.required'=>'请上传图片',
                'img.image'=>'请正确选择图片',
                'img.max'=>'图片最大不能超过1M',
                'img.min'=>'图片最小不能小于50kb',
                'captcha.required'=>'请填写验证码',
                'captcha.captcha'=>'验证码有误',
            ]);
        //接收图片保存
        $img = $request->file('shop_img');
        $path = $img->store('public/user');
        //数据无误,保存
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
        $shop->status = 0;
        $shop->save();
        $user = new User();
        $user->status = 1;
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->remember_token = uniqid();
        $user->shop_id = $shop->id;
        $user->save();
        //设置提示信息
        return redirect()->route('users.index')->with('success','添加成功');
    }

    public function destroy(User $user)
    {
        $user->delete();
        //跳转页面
        return redirect()->route('users.index')->with('success','删除成功');
    }

    public function edit(User $user)
    {
        //加载页面
        return view('user.edit',compact('user'));
    }

    public function update(User $user,Request $request)
    {
        //接收数据验证表单,有误返回提示
        $this->validate($request,['name'=>'required','email'=>'required|email','password'=>'required','status'=>'required',],
            ['name.required'=>'请输入用户名',
                'email.required'=>'请输入邮箱',
                'email.email'=>'邮箱格式错误',
                'password.required'=>'请输入密码',
                'status.required'=>'请选择状态',
            ]);
//        $a = Hash::check($request->password,$user->password);
        //接收图片保存
        //数据无误,保存
        if($user->password == $request->password){
            $user->update(['name'=>$request->name,'email'=>$request->email,'status'=>$request->status,'shop_id'=>$request->shop_id]);
        }else{
            $user->update(['name'=>$request->name,'email'=>$request->email,'status'=>$request->status,'shop_id'=>$request->shop_id,'password'=>Hash::make($request->password),]);
        };
        //设置提示信息
        return redirect()->route('users.index')->with('success','修改成功');
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
    }


}
