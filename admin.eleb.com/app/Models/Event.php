<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //设置安全字段
    protected $fillable = ['title','content','signup_start','signup_end','prize_date','signup_num','is_prize'];
}
