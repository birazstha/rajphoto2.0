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
            'others' => $this->analyticService->getTodaysTransactions($request),
            'transactions' => $this->analyticService->getTodaysTransactionsTest($request),
        ];

        return view('frontend.chart.index', $data);
    }
}
