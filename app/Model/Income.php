<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Income extends Model
{
    public $timestamps = false;

    protected $table = 'incomes';
    protected $fillable = ['amount','type','date'];
}
