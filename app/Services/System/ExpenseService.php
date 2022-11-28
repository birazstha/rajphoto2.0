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
        $query = $this->query();
        if (isset($data->keyword) && $data->keyword !== null) {
            $query->where('title', 'ILIKE', '%'.$data->keyword.'%');
        }
    

        return $query->orderBy('rank', 'ASC')->get();
    }

    

   

   
}
