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
        $array1 = collect($data['bills']);
        $array2 = collect($data['transactions']);

        $data['merged'] = $array1->merge($array2);

        $data['test'] = $data['merged']->sortByDesc('total_amount');


        $data['incomes'] =  $data['test']->mapWithKeys(function ($item, $key) {
            if (isset($item->income_id)) {
                return [$item->incomes->name => $item->total_amount];
            } else {
                return [$item->sizes->name . ' (' . $item->sizes->orders->name . ')' => $item->total_amount];
            }
        });



        return view('frontend.chart.index', $data);
    }
}
