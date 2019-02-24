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
