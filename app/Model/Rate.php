<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Rate extends Model
{

    protected $table = 'rates';
    protected $fillable = ['order_id','size_id','status'];

    public function orders(){
        return $this->belongsTo(Order::class,'order_id');
    }

    public function sizes(){
        return $this->belongsTo(Size::class,'size_id');
    }
}
