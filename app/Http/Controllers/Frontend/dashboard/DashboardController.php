<?php

namespace App\Http\Controllers\Frontend\dashboard;

use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Model\Transaction;
use App\Services\frontend\OrderService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->moduleName = 'Dashboard';
    }
    
   
    public function dashboard(Request $request){
        $data['pageTitle'] = $this->moduleName;
        $data['transactions'] =  Transaction::where('created_at', '>=', Carbon::today())->orderBy('created_at', 'DESC')->with(['bills', 'expenses', 'banks'])->get();
        $data['totalIncome'] = collect($data['transactions'])->where('bill_id')->sum('amount') + collect($data['transactions'])->where('income_id')->sum('amount');
        $data['totalExpense'] = collect($data['transactions'])->where('expense_id')->sum('amount');
        $data['totalSaving'] =  collect($data['transactions'])->where('saving_id')->sum('amount');
        $data['withdrawn'] = $data['transactions']->where('is_withdrawn', true)->sum('amount');
       
       return view('frontend.dashboard.index',$data);
    }
}
