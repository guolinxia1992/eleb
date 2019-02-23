<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
class Shop extends Model
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
    ];
    public function img()
    {
        return $this->shop_img?Storage::url($this->shop_img):'';
    }
}
