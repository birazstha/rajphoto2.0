<?php

namespace App\Services\frontend;

use App\Model\Adjustment;
use App\Services\Service;

class AdjustmentService extends Service
{
    public function __construct(Adjustment $adjustment)
    {
        parent::__construct($adjustment);
    }

    public function updateAdjustment($request){
        $data = $this->model->where('date',$request->ordered_date);
        $closingAmount = $data->first()->closing_balance;
        $updatedClosingAmnt = $closingAmount + $request->paid_amount;
        if($data){
            $data->update([
                'closing_balance'=>$updatedClosingAmnt,
            ]);
        }
    }


}


