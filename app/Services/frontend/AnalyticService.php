<?php

namespace App\Services\frontend;

use App\Model\Analytic;
use Carbon\Carbon;
use App\Services\Service;
use App\Model\Transaction;
use Illuminate\Support\Facades\DB;

class AnalyticService extends Service
{
    protected $orderService, $frontendUser;
    public function __construct(Analytic $analytic)
    {
        parent::__construct($analytic);
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

        return $query->orderBy('created_at', 'DESC')->where('created_at', '>=', Carbon::today())->whereNull(['saving_id', 'bill_id'])->where('is_withdrawn', false)->paginate(10);
    }

    public function getTodaysTransactions()
    {

        return  $this->model->select(
            DB::raw("(sum(amount)) as total_amount"),
            'income_id',
            DB::raw("count(income_id)")
        )

            ->groupBy('income_id')
            ->get();
    }


    public function store($request)
    {
        $date =  Carbon::now()->format('Y-m-d');
        try {
            if (isset($request->bill)) {
                $billArray = [];
                foreach ($request->bill as  $bill) {
                    $innerData['income_id'] = $bill['order_id'];
                    $innerData['amount'] = $request->paid_amount;
                    $innerData['size_id'] = $bill['size_id'];
                    $innerData['date'] = $date;
                    array_push($billArray, $innerData);
                }
                return $this->model::insert($billArray);
            } else {
                $data['date'] = $date;
                $data['income_id'] = $request->transaction_title_id ?? ''; //Photo, Lamination, SIM
                $data['amount'] = $request->total ?? null; //Photo, Lamination, SIM
                Analytic::create($data);
            }
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
