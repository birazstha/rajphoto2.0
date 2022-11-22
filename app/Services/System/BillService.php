<?php

namespace App\Services\System;

use App\Model\Bill;
use App\Model\Order;
use App\Services\Service;

class BillService extends Service
{

    protected $orderService, $frontendUser;
    public function __construct(Bill $bill)
    {

        parent::__construct($bill);
        $this->orderService = new OrderService(new Order);

        $this->module = 'Prepare Bill';
    }

    public function getAllData($data, $selectedColumns = [], $pagination = true)
    {
        $query = $this->query();

        if (isset($data->keyword) && $data->keyword !== null) {
            $query->where('name', 'ILIKE', '%' . $data->keyword . '%');
        }
    

        if (isset($data->order_id)) {
            return $query->where('order_id', $data->order_id)->paginate(PAGINATE);
        }

        if ($pagination) {
            return $query->orderBy('created_at', 'DESC')->paginate(PAGINATE);
        }
        return $query->orderBy('id', 'ASC')->get();
    }

    


    public function createPageData($request)
    {

        return [
            'orders' => $this->orderService->getAllData($request->merge(['pluck' => true])),
            'users' => $this->frontendUser->getAllData($request),
            'status' => $this->status(),
            'order_id' => $request->order_id,
            'pageTitle' => $this->module,

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

    public function getBillByCustomer($id)
    {
       $query = $this->query();

       return $query->where('customer_id',$id)->get();

        # code...
    }

}
