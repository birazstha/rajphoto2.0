<?php

namespace App\Services\frontend;


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

        $query = $this->query()->active();

        if (isset($data->keyword) && $data->keyword !== null) {
            $query->where('label', 'LIKE', '%' . $data->keyword . '%');
        }
        if (count($selectedColumns) > 0) {
            $query->select($selectedColumns);
        }

        if ($data->details == 'required') {
            $query->where('details_required', true)->get();
        }

        if ($data->details == 'not-required') {
            $query->where('details_required', false)->get();
        }
        return $query->orderBy('id', 'ASC')->get();
    }

    public function getIncomes()
    {
        return $this->model->where('details_required', false)->orderBy('rank', 'ASC')->get();
    }

    public function getBillClearanceId()
    {
        return $this->model->where('name', 'Bill Clearance')->first()->id ?? null;
    }
}
