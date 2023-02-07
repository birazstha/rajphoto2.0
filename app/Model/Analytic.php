<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;


class Analytic extends Model
{

  protected $table = 'analytics';
  protected $fillable = [
    'income_id', 'size_id', 'amount', 'date', 'bill_id', 'transaction_id'
  ];

  public function incomes()
  {
    return $this->belongsTo(Order::class, 'income_id');
  }
  public function sizes()
  {
    return $this->belongsTo(Size::class, 'size_id');
  }

  public function bills()
  {
    return $this->belongsTo(Bill::class, 'bill_id');
  }
}
