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

        if (isset($data->pluck)) {

            return $query->orderBy('id', 'ASC')->where('details_required',true)->pluck('name', 'id');
       }

        if(isset($data->details)){
            if($data->details === 'required'){
                 $query->where('details_required',true)->orderBy('rank','ASC')->get();
            }else{
                 $query->where('details_required',false)->orderBy('rank','ASC')->get();
            }
        }

        if ($pagination) {
            return $query->orderBy('id', 'ASC')->get();
        }

        
        return $query->orderBy('id', 'ASC')->get();
    }

    

   

   
}
