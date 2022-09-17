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
        if (count($selectedColumns) > 0) {
            $query->select($selectedColumns);
        }

        // if(isset($data->today)){

        //     $query->where('created_at', 'ILIKE', '%'. date('Y-m-d') . '%')->paginate(10);
        // }

        if (isset($data->order_id)) {
            return $query->where('order_id', $data->order_id)->paginate(PAGINATE);
        }

        if ($pagination) {
            return $query->orderBy('id', 'ASC')->paginate(PAGINATE);
        }
        return $query->orderBy('id', 'ASC')->get();
    }

    public function update($request, $id)
    {
        $data['status'] = true;
        $data['cleared_by'] = $request->user_id;
        $data['cleared_date'] = $request->cleared_date;
        $data['cash_received'] = $request->cash_received;
        $data['cash_return'] = $request->cash_return;
        $update = $this->itemByIdentifier($id);
        $update->fill($data)->save();
        $update = $this->itemByIdentifier($id);

        return $update;
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
}
