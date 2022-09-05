<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Bill extends Model
{
  use HasFactory;

    protected $table = 'bills';
    protected $fillable = ['name','quantity','name','rate','total','grand_total','paid_amount','balance_amount','cash_received','cash_return','ordered_date','delivery_date','user_id','qr_code'];

   public function billOrders(){
     return $this->hasMany(BillOrder::class);
   }

   public function users(){
    return $this->belongsTo(FrontendUser::class,'user_id');
   }
}
