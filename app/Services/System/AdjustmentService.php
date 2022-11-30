<?php

namespace App\Services\System;

use App\Model\Adjustment;
use App\Model\Order;
use App\Services\Service;

class AdjustmentService extends Service
{
    public function __construct(Adjustment $adjustment)
    {
        parent::__construct($adjustment);
    }

    public function getClosingBalance($request){
       
        $query = $this->query();
        return $query->where('date', $request->prevDate)->first()->closing_balance ?? 0;
    }
}


