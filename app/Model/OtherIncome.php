<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class OtherIncome extends Model
{
  use HasFactory;

    protected $table = 'other_incomes';
    protected $fillable = ['order_id','date','rate','total','quantity'];

   public function orders(){
     return $this->belongsTo(Order::class,'order_id');
   }
}
