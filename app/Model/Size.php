<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

<<<<<<< HEAD
=======

>>>>>>> 056d438f8dd74b2d5f5eec06b60f96ecd6fba377
class Size extends Model
{

    protected $table = 'sizes';
<<<<<<< HEAD
    protected $fillable = ['title','order_id','status'];
=======
    protected $fillable = ['order_id','name','status'];
>>>>>>> 056d438f8dd74b2d5f5eec06b60f96ecd6fba377

    public function orders(){
        return $this->belongsTo(Order::class,'order_id');
    }
<<<<<<< HEAD
=======
    
>>>>>>> 056d438f8dd74b2d5f5eec06b60f96ecd6fba377
}
