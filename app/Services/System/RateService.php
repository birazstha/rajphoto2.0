<?php

namespace App\Services\System;

use App\Model\Order;
use App\Model\Rate;
use App\Model\Size;
use App\Services\Service;

class RateService extends Service
{
     protected $orderService,$sizeService;
    public function __construct(Rate $rate)
    {
        parent::__construct($rate);
        $this->orderService = new OrderService(new Order);
        $this->sizeService = new SizeService(new Size);
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

        if(isset($data->order_id)){
            return $query->where('order_id',$data->order_id)->get();   
        }

        if ($pagination) {
            return $query->orderBy('id', 'ASC')->paginate(PAGINATE);
        }

        return $query->orderBy('id', 'ASC')->get();
    }

    public function createPageData($request){
        return[
            'orders' => $this->orderService->getAllData($request->merge(['pluck'=>true])),
            'sizes' => $this->sizeService->getAllData($request->merge(['pluck'=>true])),
            'status'=>$this->status(),
            'order_id'=>$request->order_id,
        ];
    }

    public function editPageData($request, $id)
    {
        return[
            'item' => $this->itemByIdentifier($id),
            'orders' => $this->orderService->getAllData($request->merge(['pluck'=>true])),
            'status'=>$this->status(),
            'order_id'=>$request->order_id,
        ];
    }
       


    public function indexPageData($request){
        return[
            'items' => $this->getAllData($request),
            'order_id'=>$request->order_id,
        ];
    }

    

   
}
