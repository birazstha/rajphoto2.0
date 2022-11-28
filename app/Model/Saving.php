<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Saving extends Model
{

    protected $table = 'banks';
    protected $fillable = ['bank_name','status'];

    public function orders(){
        return $this->belongsTo(Order::class,'order_id');
    }

    public function sizes(){
        return $this->belongsTo(Size::class,'size_id');
    }
}
