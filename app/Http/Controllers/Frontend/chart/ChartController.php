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
            'elections' => ['NCP' => 1200, 'RSP' => 12000, 'JSP' => 1200, 'UML' => 1200]
        ];


        // return view('frontend.chart.index_chart', $data);
        return view('frontend.chart.index', $data);
    }
}
