<?php

namespace App\Http\Controllers\Frontend\dashboard;

use App\Http\Controllers\Controller;
use App\Model\Adjustment;
use App\Model\Analytic;
use App\Model\Order;
use App\Model\Transaction;
use App\Services\frontend\AdjustmentService;
use App\Services\frontend\AnalyticService;
use App\Services\frontend\TransactionService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    protected $adjustmentService, $transactionService, $moduleName, $analyticService;
    public function __construct()
    {
        $this->moduleName = 'Dashboard';
        $this->adjustmentService = new AdjustmentService(new Adjustment);
        $this->transactionService = new TransactionService(new Transaction);
        $this->analyticService = new AnalyticService(new Analytic());
    }


    public function dashboard(Request $request)
    {

        $data['pageTitle'] = $this->moduleName;
        $data['transactions'] = $this->transactionService->getTodaysTransactions($request);

        $data['totalIncome'] = collect($data['transactions'])->where('bill_id')->sum('amount') + collect($data['transactions'])->where('income_id')->sum('amount');

        $data['totalExpense'] = collect($data['transactions'])->where('expense_id')->sum('amount');
        $data['totalSaving'] =  collect($data['transactions'])->where('saving_id')->sum('amount');
        $data['withdrawn'] = $data['transactions']->where('is_withdrawn', true)->sum('amount');
        $data['adjustment'] = Adjustment::where('created_at', '>=', Carbon::today())->first()->adjusted_amount ?? 0;


        $data['onlinePaymentBill'] = collect($data['transactions'])->where('payment_gateway')->where('bill_id')->sum('amount');
        $data['onlinePaymentOther'] = collect($data['transactions'])->where('payment_gateway')->where('income_id')->sum('amount');
        $data['totalOnlinePayment'] = $data['onlinePaymentBill'] + $data['onlinePaymentOther'];
        $data['openingBalance'] =  $this->adjustmentService->getClosingBalance();



        $data['closingBalance'] =  $data['openingBalance'] + $data['totalIncome'] +  $data['adjustment'] - $data['totalExpense'] - $data['totalSaving'] - $data['withdrawn'] - $data['onlinePaymentBill'] - $data['onlinePaymentOther'];


        $data['analytics'] = $this->analyticService->chart($request);

        // dd($data['closingBalance']);

        return view('frontend.dashboard.index', $data);
    }

    public function filter(Request $request, $type)
    {
        $data['pageTitle'] = $this->moduleName;
        $data['transactions'] = $this->transactionService->getTodaysTransactions($request);
        $data['totalIncome'] = collect($data['transactions'])->where('bill_id')->sum('amount') + collect($data['transactions'])->where('income_id')->sum('amount');
        $data['totalExpense'] = collect($data['transactions'])->where('expense_id')->sum('amount');
        $data['totalSaving'] =  collect($data['transactions'])->where('saving_id')->sum('amount');
        $data['withdrawn'] = $data['transactions']->where('is_withdrawn', true)->sum('amount');
        $data['adjustment'] = Adjustment::where('created_at', '>=', Carbon::today())->first()->adjusted_amount ?? 0;
        $data['onlinePaymentBill'] = collect($data['transactions'])->where('payment_gateway')->where('bill_id')->sum('amount');
        $data['onlinePaymentOther'] = collect($data['transactions'])->where('payment_gateway')->where('income_id')->sum('amount');
        $data['totalOnlinePayment'] = $data['onlinePaymentBill'] + $data['onlinePaymentOther'];
        $data['openingBalance'] =  $this->adjustmentService->getClosingBalance();
        $data['closingBalance'] =  $data['openingBalance'] + $data['totalIncome'] +  $data['adjustment'] - $data['totalExpense'] - $data['totalSaving'] - $data['withdrawn'] - $data['onlinePaymentBill'] - $data['onlinePaymentOther'];

        if ($type === 'income') {
            $data['transactions'] = $this->transactionService->fetchIncomeData();
            return view('frontend.dashboard.index', $data);
        } elseif ($type === 'expense') {
            $data['transactions'] = $this->transactionService->fetchExpenseData();
            return view('frontend.dashboard.index', $data);
        } elseif ($type === 'savings') {
            $data['transactions'] = $this->transactionService->fetchSavingData();
            return view('frontend.dashboard.index', $data);
        } elseif ($type === 'online-payment') {
            $data['transactions'] = $this->transactionService->fetchOnlinePaymentData();
            return view('frontend.dashboard.index', $data);
        } elseif ($type === 'bill') {
            $data['transactions'] = $this->transactionService->fetchBillData();
            return view('frontend.dashboard.index', $data);
        }
    }
}
