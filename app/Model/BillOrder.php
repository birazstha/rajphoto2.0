<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class BillOrder extends Model
{

    protected $table = 'bill_orders';
    protected $fillable = ['bill_id','order_id','size_id','quantity','rate','total'];  

    public function orders(){
        return $this->belongsTo(Order::class,'order_id');
    }

    public function size_id(){
        return $this->belongsTo(Size::class,'size_id');
    }
}
