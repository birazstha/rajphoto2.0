<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Order extends Model
{

    protected $table = 'orders';
<<<<<<< HEAD
    protected $fillable = ['name','status','details_required','rank'];
=======
    protected $fillable = ['size_id','name','status','rank','details_required'];
>>>>>>> 056d438f8dd74b2d5f5eec06b60f96ecd6fba377

    public function sizes(){
        return $this->hasMany(Size::class);
    }
<<<<<<< HEAD
=======
    
>>>>>>> 056d438f8dd74b2d5f5eec06b60f96ecd6fba377
}
