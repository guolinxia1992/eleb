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

Route::get('/', function () {
    return view('layout.template');
})->name('home');

//商家管理
Route::resource('users','UserController');
//登录和注销
Route::get('login','UserController@login')->name('login');
Route::post('login','UserController@checkLogin')->name('login');
Route::get('logout','UserController@logout')->name('logout');
//修改密码
Route::get('changePwd','UserController@changePwd')->name('changePwd');
Route::post('saveNewPwd','UserController@saveNewPwd')->name('saveNewPwd');

//菜品分类管理
Route::resource('menucategories','MenuCategoryController');
//菜品管理
Route::resource('menus','MenuController');
//查看单个分类的所有菜品
Route::get('menus/{menucategory}/showDetail','MenuController@showDetail')->name('menus.showDetail');

//查看活动页面
Route::resource('activities','ActivityController');
//订单列表
Route::get('orders/index','OrderController@index')->name('orders.index');
Route::get('orders/{order}/show','OrderController@show')->name('orders.show');
Route::get('orders/{order}/cancel','OrderController@cancel')->name('orders.cancel');
Route::get('orders/{order}/accept','OrderController@accept')->name('orders.accept');
Route::get('orders/orderLook','OrderController@orderLook')->name('orders.orderLook');
Route::get('orders/menuLook','OrderController@menuLook')->name('orders.menuLook');

//抽奖活动管理
Route::resource('eventmembers','EventMemberController');
//报名
Route::get('eventmembers/{id}/store','EventMemberController@store')->name('eventmembers.store');
//查看中奖结果
Route::get('eventprizes/{event}/show','EventPrizeController@show')->name('eventprizes.show');
