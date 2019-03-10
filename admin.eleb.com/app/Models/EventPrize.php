<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventPrize extends Model
{
    //多对一模型
    public function event()
    {
        return $this->belongsTo(Event::class,'events_id','id');
    }
    //设置安全字段
    protected $fillable = ['name','title','events_id','description','member_id'];
}
