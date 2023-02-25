<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Adjustment extends Model
{

    protected $table = 'adjustments';
    protected $fillable = ['adjusted_amount', 'amount', 'date', 'type', 'created_at'];
}
