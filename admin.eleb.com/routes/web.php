<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
////
//Route::get('/', function () {
//    return view('layout.app');
//})->name('home');
Route::get('/', function () {
    $navs = \App\Models\Nav::where('pid','<>',0)->get();
    $topnavs = \App\Models\Nav::where('pid','=','0')->get();
//    dd($topnavs);
    return view('layout.app',compact('navs','topnavs'));
})->name('home');
//Route::resource('users,UserController');
//Route::resource('users','UserController');
//Route::get('/index', function () {
//    return view('user.index');
//});
//Route::get('/users', 'UserController@index')->name('users.index');//用户列表
//Route::get('/', 'http://admin.eleb.com')->name('home');
Route::resource('users','UserController');
Route::resource('shopcategories','ShopCategoryController');
Route::resource('shops','ShopController');
Route::get('checkShop/{shop}','ShopController@checkShop')->name('shops.checkShop');
//管理员路由
Route::resource('admins','AdminController');
//登录和注销
Route::get('login','AdminController@login')->name('login');
Route::post('login','AdminController@checkLogin')->name('login');
Route::get('logout','AdminController@logout')->name('logout');

//修改密码
Route::get('changePwd','AdminController@changePwd')->name('changePwd');
Route::post('saveNewPwd','AdminController@saveNewPwd')->name('saveNewPwd');
//活动管理
Route::resource('activities','ActivityController');

//上传图片
Route::post('/upload','ShopCategoryController@upload')->name('upload');

//会员管理
Route::get('members/index','MemberController@index')->name('members.index');
Route::get('members/{member}/show','MemberController@show')->name('members.show');
Route::get('members/{member}/disable','MemberController@disable')->name('members.disable');

//权限管理
Route::resource('permissions','PermissionController');
//角色管理
Route::resource('roles','RoleController');
//导航管理
Route::resource('navs','NavController');
//Route::resource('navs/nav','NavController@nav');

//抽奖活动管理
Route::resource('events','EventController');
Route::get('events/{event}/start','EventController@start')->name('events.start');
Route::get('events/{event}/result','EventController@result')->name('events.result');
Route::resource('eventmembers','EventMemberController');
Route::resource('eventprizes','EventPrizeController');

////邮件发送
//Route::get('/mail',function(){
//    $title = '全新体验，手机也能玩转网易邮箱2.0';
//    $content = '<p>
//重要的邮件如何才能让<span style="color: red">对方立刻查看</span>！
//随身邮，可以让您享受随时短信提醒和发送邮件可以短信通知收件人的服务，重要的邮件一个都不能少！</p>';
////    try{
//        \Illuminate\Support\Facades\Mail::send('email.email',compact('title','content'),
//            function($message){
//                $to = '592975640@qq.com';
//                $message->from(env('MAIL_USERNAME'))->to($to)->subject('阿里云数据库10月刊:Redis2发布');
//            });
////    }catch (Exception $e){
////        return '邮件发送失败';
////    }
//});
