<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $table = 'expenses';
    protected $fillable = [
        'title', 'status', 'rank'
    ];

    public function scopeActive($query)
    {
        dd($query);
        return $query->where('status', 1);
    }

}
