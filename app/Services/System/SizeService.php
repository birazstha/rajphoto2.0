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
            $query->where('name', 'ILIKE', '%' . $data->keyword . '%');
        }
        if (count($selectedColumns) > 0) {
            $query->select($selectedColumns);
        }



        if (isset($data->urgentId)) {
            return $query->where('order_id', $data->urgentId)->get();
        }

        if (isset($data->order_id)) {
            return $query->where('order_id', $data->order_id)->get();
        }

        if (isset($data->pluck)) {
            return $query->orderBy('id', 'ASC')->pluck('name', 'id');
        }

        if ($pagination) {
            return $query->orderBy('id', 'ASC')->paginate(PAGINATE);
        }

        return $query->orderBy('id', 'ASC')->get();
    }

    public function createPageData($request)
    {
        return [
            'orders' => $this->orderService->getAllData($request->merge(['pluck' => true])),
            'status' => $this->status(),
            'order_id' => $request->order_id,
        ];
    }

    public function editPageData($request, $id)
    {
        return [
            'item' => $this->itemByIdentifier($id),
            'orders' => $this->orderService->getAllData($request->merge(['pluck' => true])),
            'status' => $this->status(),
            'order_id' => $request->order_id,
        ];
    }



    public function indexPageData($request)
    {
        return [
            'items' => $this->getAllData($request),
            'order_id' => $request->order_id,
        ];
    }
}
