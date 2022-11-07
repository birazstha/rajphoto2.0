<?php

namespace App\Services\System;

use App\Model\Adjustment;
use App\Model\Order;
use App\Services\Service;

class AdjustmentService extends Service
{
     protected $orderService;
    public function __construct(Adjustment $size)
    {
        parent::__construct($size);
        $this->orderService = new OrderService(new Order);
    }

  

    public function getClosingBalance($request){

        $query = $this->query();
        return $query->where('date', $request->prevDate)->first()->closing_balance;
    }

      
}


