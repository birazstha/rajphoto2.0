<?php

namespace App\Http\Controllers\Frontend\dashboard;

use App\Http\Controllers\Controller;
use App\Model\Adjustment;
use App\Model\Order;
use App\Model\Transaction;
use App\Services\frontend\AdjustmentService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    protected $adjustmentService;
    public function __construct()
    {
        $this->moduleName = 'Dashboard';
        $this->adjustmentService = new AdjustmentService(new Adjustment);
    }


    public function dashboard(Request $request)
    {
        $data['pageTitle'] = $this->moduleName;
        $data['transactions'] =  Transaction::where('created_at', '>=', Carbon::today())->orderBy('created_at', 'DESC')->with(['bills', 'expenses', 'banks'])->get();
        $data['totalIncome'] = collect($data['transactions'])->where('bill_id')->sum('amount') + collect($data['transactions'])->where('income_id')->sum('amount');
        $data['totalExpense'] = collect($data['transactions'])->where('expense_id')->sum('amount');
        $data['totalSaving'] =  collect($data['transactions'])->where('saving_id')->sum('amount');
        $data['withdrawn'] = $data['transactions']->where('is_withdrawn', true)->sum('amount');
        $data['adjustment'] = Adjustment::where('created_at', '>=', Carbon::today())->first()->adjusted_amount ?? 0;
        $data['onlinePaymentBill'] = collect($data['transactions'])->where('payment_method')->where('bill_id')->sum('amount');
        $data['onlinePaymentOther'] = collect($data['transactions'])->where('payment_method')->where('income_id')->sum('amount');

        $data['totalOnlinePayment'] = $data['onlinePaymentBill'] + $data['onlinePaymentOther'];


        $data['openingBalance'] =  $this->adjustmentService->getClosingBalance();

        $data['closingBalance'] =  $data['openingBalance'] + $data['totalIncome'] +  $data['adjustment'] - $data['totalExpense'] - $data['totalSaving'] - $data['withdrawn'] - $data['onlinePaymentBill'] - $data['onlinePaymentOther'];

        return view('frontend.dashboard.index', $data);
    }
}
