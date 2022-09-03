<?php

namespace App\Services\System;

use App\Model\BillOrder;
use App\Model\Order;
use App\Services\Service;

class BillOrderService extends Service
{
    public function __construct(BillOrder $billOrder)
    {
        parent::__construct($billOrder);
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
            return $query->orderBy('id', 'ASC')->paginate(PAGINATE);
        }
        if ($pagination) {
            return $query->orderBy('id', 'ASC')->get();
        }

        
        return $query->orderBy('id', 'ASC')->get();
    }

    public function store($request)
    {
        $billArray = [];
        foreach ($request->bill as $key => $bill) {
            $innerData = $bill;
            $innerData['bill_id'] = $request->bill_id;
            array_push($billArray, $innerData);
        }
        return $this->model::insert($billArray);
    }

   

   
}
