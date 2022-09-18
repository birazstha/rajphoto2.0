<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Order extends Model
{

    protected $table = 'orders';
    protected $fillable = ['name','status','rank','details_required','rate'];

    public function sizes(){
        return $this->hasMany(Size::class);
    }

}
