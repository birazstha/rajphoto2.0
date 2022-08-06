<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Order extends Model
{

    protected $table = 'orders';
    protected $fillable = ['name','status','details_required','rank'];
}
