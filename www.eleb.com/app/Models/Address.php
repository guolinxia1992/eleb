<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //设置安全字段
    protected $fillable = ['user_id','provence','city','area','is_default','address','tel','name'];
}
