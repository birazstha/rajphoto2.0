<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;


class Analytic extends Model
{

  protected $table = 'analytics';
  protected $fillable = [
    'income_id', 'size_id', 'amount', 'date'
  ];

  public function incomes()
  {
    return $this->belongsTo(Order::class, 'income_id');
  }
  public function sizes()
  {
    return $this->belongsTo(Size::class, 'size_id');
  }
}
