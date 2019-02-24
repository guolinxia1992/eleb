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
    return view('layout.app');
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