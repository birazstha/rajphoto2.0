<?php

namespace App\Services\System;

use App\Model\FrontendUser;
use App\Model\Order;
use App\Services\Service;

class FrontendUserService extends Service
{
    public function __construct(FrontendUser $frontendUser)
    {
        parent::__construct($frontendUser);
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
