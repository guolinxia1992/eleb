<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
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
        'name',
        'email',
        'password',
        'shop_id'
    ];
}
