<?php

namespace App\Services\System;

use App\Model\Order;
use App\Model\Size;
<<<<<<< HEAD
use App\Services\frontend\OrderService;
use App\Services\Service;


class SizeService extends Service
{
    protected $orderService;
=======
use App\Services\Service;

class SizeService extends Service
{
     protected $orderService;
>>>>>>> 056d438f8dd74b2d5f5eec06b60f96ecd6fba377
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
<<<<<<< HEAD
    

    public function createPageData($request)
    {
        return [
            'orders'=>$this->orderService->getAllData($request),
            'status'=>$this->status()
        ];
    }

    public function editPageData($request, $id)
    {
        $size = $this->itemByIdentifier($id);
        return [
            'item'=>$size,
            'orders'=>$this->orderService->getAllData($request),
            'status'=>$this->status()
=======

    public function createPageData($request){
        return[
            'orders' => $this->orderService->getAllData($request->merge(['pluck'=>true])),
            'status'=>$this->status(),
>>>>>>> 056d438f8dd74b2d5f5eec06b60f96ecd6fba377
        ];
    }

   
}
