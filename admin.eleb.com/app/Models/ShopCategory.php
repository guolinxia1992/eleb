<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ShopCategory extends Model
{
    //设置安全字段
    protected $fillable = ['name','img','status','file'];

    public function img()
    {
        return $this->img?Storage::url($this->img):'';
    }
}
