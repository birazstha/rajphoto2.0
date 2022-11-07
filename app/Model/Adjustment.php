<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Adjustment extends Model
{

    protected $table = 'adjustments';
    protected $fillable = ['closing_balance','adjusted_amount','amount','date'];

    
}
