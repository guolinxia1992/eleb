<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventPrize extends Model
{
    //
    public function show()
    {
        return $this->belongsTo(User::class,'member_id','id');
    }
}
