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
                'closing_balance' => $updatedClosingAmnt,
            ]);
        }
    }

    public function deductClosingBalance($request)
    {
        $data = $this->model->where('date', $request->date);
        $closingAmount = $data->first()->closing_balance ?? 0;
        $updatedClosingAmnt = $closingAmount - $request->amount - $request->withdrawn_amount;
        if ($data) {
            $data->update([
                'closing_balance' => $updatedClosingAmnt,
            ]);
        }
    }

    public function getClosingBalance()
    {
        return $this->model->where('created_at', '>=', Carbon::yesterday())->first()->closing_balance ?? 0;
    }

    public function store($request)
    {
        $this->model->create($request->except('_token'));
    }
}
