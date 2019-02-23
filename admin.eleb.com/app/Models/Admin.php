<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    //设置安全字段
    protected $fillable = ['name','password','email','newpassword','newpassword1'];

    public static function alert($str){
        echo "<script>alert('$str')</script>";
        exit;
    }
}
