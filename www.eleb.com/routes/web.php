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
    return redirect('view/#');
});

Route::get('/api/businessList','ApiController@businessList');
Route::get('/api/business','ApiController@business');
Route::post('/api/regist','ApiController@regist');
Route::get('/api/sms','ApiController@sms');
Route::post('/api/checkLogin','ApiController@checkLogin');
Route::post('/api/address','ApiController@address');
Route::post('/api/addAddress','ApiController@addAddress');
Route::get('/api/addressList','ApiController@addressList');
Route::get('/api/address','ApiController@address');
Route::post('/api/editAddress','ApiController@editAddress');
Route::post('/api/addCart','ApiController@addCart');
Route::get('/api/cart','ApiController@cart');
Route::post('/api/addOrder','ApiController@addOrder');
Route::get('/api/order','ApiController@order');
Route::get('/api/orderList','ApiController@orderList');
Route::post('/api/changePassword','ApiController@changePassword');
Route::post('/api/forgetPassword','ApiController@forgetPassword');
