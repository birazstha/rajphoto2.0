<?php

namespace App\Http\Controllers\Frontend\chart;

use App\Http\Controllers\Controller;
use App\Model\Analytic;
use App\Services\frontend\AnalyticService;
use Illuminate\Http\Request;


class ChartController extends Controller
{

    protected $analyticService;
    public function __construct()
    {
        $this->analyticService = new AnalyticService(new Analytic());
    }


    public function index(Request $request)
    {
        $data = [
            'bills' => $this->analyticService->getTodaysTransactions($request),
            'transactions' => $this->analyticService->getTodaysTransactionsTest($request),
        ];


        $bill = $data['bills']->mapWithKeys(function ($item, $key) {
            return [$item->sizes->name . '(' . $item->sizes->orders->name . ')' => $item->total_amount];
        });

        $transaction = $data['transactions']->mapWithKeys(function ($item, $key) {
            return [$item->incomes->name => $item->total_amount];
        });

        $array1 = collect($bill);
        $array2 = collect($transaction);

        $data['incomes'] = $array1->merge($array2);



        return view('frontend.chart.index', $data);
    }
}
