<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Size extends Model
{

    protected $table = 'sizes';
    protected $fillable = ['order_id','name','status'];

    public function orders(){
        return $this->belongsTo(Order::class,'order_id');
    }
}
