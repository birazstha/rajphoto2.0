<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Bill extends Model
{
  use HasFactory;

    protected $table = 'bills';
    protected $fillable = ['customer_id','quantity','rate','total','grand_total','paid_amount','due_amount','cash_received','cash_return','ordered_date','delivery_date','user_id','qr_code','status','cleared_date','cleared_by'];

   public function billOrders(){
     return $this->hasMany(BillOrder::class);
   }

   public function users(){
    return $this->belongsTo(FrontendUser::class,'user_id');
   }

   public function customers(){
    return $this->belongsTo(Customer::class,'customer_id');
   }

   
}
