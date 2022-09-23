<?php

namespace App\Services\System;

use App\Model\Expense;
use App\Services\Service;

class ExpenseService extends Service
{
    public function __construct(Expense $expense)
    {
        parent::__construct($expense);
    }

    public function getAllData($data, $selectedColumns = [], $pagination = true)
    {
        // dd($data->pluck);
        $query = $this->query();
        if (isset($data->keyword) && $data->keyword !== null) {
            $query->where('label', 'LIKE', '%'.$data->keyword.'%');
        }
        if (count($selectedColumns) > 0) {
            $query->select($selectedColumns);
        }

        if(isset($data->pluck)){
            return $query->orderBy('id', 'ASC')->paginate(PAGINATE);
        }
        if ($pagination) {
            return $query->orderBy('id', 'ASC')->get();
        }

        
        return $query->orderBy('id', 'ASC')->get();
    }

    

   

   
}
