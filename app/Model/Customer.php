<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = ['name','customer_id','phone_number'];

     public function bills(){
        return $this->hasMany(Bill::class);
     }
}
