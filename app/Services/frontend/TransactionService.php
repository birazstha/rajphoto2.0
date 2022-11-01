<?php

namespace App\Services\frontend;


use App\Model\Transaction;
use App\Services\Service;
use Carbon\Carbon;

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

        // if (isset($data->order_id)) {
        //     return $query->where('order_id', $data->order_id)->paginate(PAGINATE);
        // }

        return $query->orderBy('created_at','DESC')->where('created_at', '>=', Carbon::today())->whereNull('saving_id')->paginate(5);
    }

    public function getSavingsDetail(){
        $query = $this->query();
        return $query->orderBy('created_at','DESC')->where('created_at', '>=', Carbon::today())->whereNotNull('saving_id')->get();
  
    }


    public function store($request)
    {
        $this->model->create($request);
        return redirect()->route('transactions.index')->with('success', 'Transaction recorded successfully!!');    
    }

   
}