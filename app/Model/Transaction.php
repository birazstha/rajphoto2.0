<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Transaction extends Model
{
  use HasFactory;
  
    protected $table = 'transactions';
    protected $fillable = ['income_id','bill_id','expense_id','saving_id','is_withdrawn','amount','date','bill_type','description','payment_method'];


   public function incomes(){
    return $this->belongsTo(Order::class,'income_id');
   }

   public function expenses(){
    return $this->belongsTo(Expense::class,'expense_id');
   }

   public function bills(){
    return $this->belongsTo(Bill::class,'bill_id');
   }

   public function savings(){
    return $this->belongsTo(Saving::class,'saving_id');
   }

   
}
