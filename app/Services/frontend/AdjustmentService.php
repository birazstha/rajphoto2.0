<?php

namespace App\Services\frontend;

use App\Model\Adjustment;
use App\Services\Service;
use Carbon\Carbon;

class AdjustmentService extends Service
{
    public function __construct(Adjustment $adjustment)
    {
        parent::__construct($adjustment);
    }

    public function updateAdjustment($request)
    {
        $data = $this->model->where('date', $request->ordered_date)
            ->orWhere('date', $request->cleared_date)
            ->orWhere('date', $request->date);
        $closingAmount = $data->first()->closing_balance ?? 0;



        if ($data && (!empty($request->paid_amount))) {

            $updatedClosingAmnt = $closingAmount + $request->paid_amount + $request->due_amount + $request->total;

            $data->update([
                'amount' => $updatedClosingAmnt,
            ]);
        }
    }

    public function deductClosingBalance($request)
    {



        $data = $this->model->where('date', $request->date);
        $closingAmount = $data->first()->amount ?? 0;
        $updatedClosingAmnt = $closingAmount - $request->amount - $request->withdrawn_amount;
        if ($data) {
            $data->update([
                'amount' => $updatedClosingAmnt,
            ]);
        }
    }

    public function getClosingBalance()
    {
        return $this->model->where('created_at', '>=', Carbon::yesterday())->first()->amount ?? 0;
    }

    public function store($request)
    {
        $data = $request->except('_token');
        if ($data['type'] === 'opening') {
            $this->model->create([
                'amount' => $data['amount'],
                'date' => $data['yesterdays_date'],
                'adjusted_amount' => 0,
                'type' => $data['type']
            ]);
        } else {
            $this->model->create([
                'amount' => $data['amount'],
                'date' => $data['todays_date'],
                'adjusted_amount' => $data['adjusted_amount'],
                'type' => $data['type']
            ]);
        }

        return $data['type'];
    }
}
