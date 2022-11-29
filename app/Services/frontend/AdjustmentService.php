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
       
        $data = $this->model->where('date',$request->ordered_date)
        ->orWhere('date',$request->cleared_date)
        ->orWhere('date',$request->date);
        $closingAmount = $data->first()->closing_balance ?? 0;
        $updatedClosingAmnt = $closingAmount + $request->paid_amount + $request->due_amount + $request->total;
        if($data){
            $data->update([
                'closing_balance'=>$updatedClosingAmnt,
            ]);
        }
    }

    public function deductClosingBalance($request)
    {
        $data = $this->model->where('date',$request->date);
        $closingAmount = $data->first()->closing_balance ?? 0;
        dd($closingAmount);
        $updatedClosingAmnt = $closingAmount - $request->amount - $request->withdrawn_amount;
        if($data){
            $data->update([
                'closing_balance'=>$updatedClosingAmnt,
            ]);
        }
    }


}


