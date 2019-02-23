<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    //设置安全字段
    protected $fillable = [
        'shop_category_id',
        'shop_name',
        'shop_img',
        'shop_rating',
        'brand',
        'on_time',
        'fengniao',
        'bao',
        'piao',
        'zhun',
        'start_send',
        'send_cost',
        'notice',
        'discount',
        'status',
        'shop_id',
        'name','email','password','newpassword','newpassword1',
    ];
    public static function alert($str,$url){
        echo "<script>alert('$str');location.href='$url';</script>";
        exit;
    }
}
