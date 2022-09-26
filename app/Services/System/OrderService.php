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

        if(isset($data->details)){
            if($data->details === 'required'){
                 $query->where('details_required',true)->get();
            }else{
                 $query->where('details_required',false)->get();
            }
        }

        if ($pagination) {
            return $query->orderBy('id', 'ASC')->get();
        }

        
        return $query->orderBy('id', 'ASC')->get();
    }

    

   

   
}
