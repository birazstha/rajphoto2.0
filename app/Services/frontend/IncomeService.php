<?php

namespace App\Services\frontend;

use App\Model\Income;
use App\Services\Service;

class IncomeService extends Service
{
    public function __construct(Income $income)
    {
        parent::__construct($income);
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
            return $query->orderBy('id', 'ASC')->get();
        }

    }

    public function store($request)
    {
        return $this->model->create($request);
    }

   
}
