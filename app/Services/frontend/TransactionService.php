<?php

namespace App\Services\frontend;


use App\Model\Transaction;
use App\Services\Service;

class TransactionService extends Service
{

    protected $orderService, $frontendUser;
    public function __construct(Transaction $bill)
    {
        parent::__construct($bill);
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

        if (isset($data->order_id)) {
            return $query->where('order_id', $data->order_id)->paginate(PAGINATE);
        }

        if ($pagination) {
            return $query->orderBy('id', 'ASC')->paginate(PAGINATE);
        }
        return $query->orderBy('id', 'ASC')->get();
    }


    public function store($request)
    {

        return $this->model->create($request);
    }

   
}
