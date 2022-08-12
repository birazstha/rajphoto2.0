<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Order extends Model
{

    protected $table = 'orders';
    protected $fillable = ['size_id','name','status','rank','details_required'];

    public function sizes(){
        return $this->hasMany(Size::class);
    }
    
}
