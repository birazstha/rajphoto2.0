<?php

namespace App\Services\System;


use App\Model\Order;
use App\Services\Service;

class OrderService extends Service
{
    public function __construct(Order $order)
    {
        parent::__construct($order);
    }

    public function getAllData($data, $selectedColumns = [], $pagination = true)
    {
        // dd($data->pluck);
        $query = $this->query();
        if (isset($data->keyword) && $data->keyword !== null) {
            $query->where('label', 'LIKE', '%'.$data->keyword.'%');
        }
        if (count($selectedColumns) > 0) {
            $query->select($selectedColumns);
        }

        if(isset($data->pluck)){
            return $query->orderBy('id', 'ASC')->pluck('name','id');
        }
        if ($pagination) {
            return $query->orderBy('id', 'ASC')->get();
        }

        
        return $query->orderBy('id', 'ASC')->get();
    }

   
}
