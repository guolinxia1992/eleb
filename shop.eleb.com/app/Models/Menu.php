<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //设置安全验证
    protected $fillable = [
        'goods_name',
        'rating	',
        'shop_id',
        'category_id',
        'description',
        'goods_price',
        'description',
        'month_sales',
        'rating_count',
        'tips',
        'satisfy_count',
        'satisfy_rate',
        'goods_img',
        'status',
    ];
    public function menuCategory()
    {
        return $this->belongsTo(MenuCategory::class,'category_id');//'APP\Student'
        //return Student::find($this->student_id);
    }
}
