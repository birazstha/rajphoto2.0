<?php

namespace App\Services\System;

use App\Model\Order;
use App\Model\Size;
use App\Services\Service;

class SizeService extends Service
{
     protected $orderService;
    public function __construct(Size $size)
    {
        parent::__construct($size);
        $this->orderService = new OrderService(new Order);
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
        if ($pagination) {
            return $query->orderBy('id', 'ASC')->paginate(PAGINATE);
        }

        return $query->orderBy('id', 'ASC')->get();
    }

    public function createPageData($request){
        return[
            'orders' => $this->orderService->getAllData($request->merge(['pluck'=>true])),
            'status'=>$this->status(),
        ];
    }

   
}
