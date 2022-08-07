<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{

    protected $table = 'sizes';
    protected $fillable = ['title','order_id','status'];

    public function orders(){
        return $this->belongsTo(Order::class,'order_id');
    }
}
