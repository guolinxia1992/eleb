<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nav extends Model
{
    //设置安全字段
    protected $fillable = ['name','url','pid'];
}
