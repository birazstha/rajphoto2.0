<?php

namespace App\Http\Controllers\Frontend\saving;

use App\Exceptions\CustomGenericException;
use App\Http\Controllers\Controller;
use App\Model\Bill;
use App\Model\Transaction;
use App\Services\frontend\ExpenseService;
use App\Services\frontend\SavingService;
use App\Services\frontend\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SavingController extends Controller
{
    protected $expenseService, $transactionService;
    public function __construct(SavingService $savingService)
    {
        $this->savingService = $savingService;
        $this->moduleName = 'Create Bill';
        $this->transactionService = new TransactionService(new Transaction);
    }

    // public function index(Request $request)
    // {
    //     $data = [
    //         'pageTitle' => 'Bills',
    //         'bills' => $this->billService->getAllData($request->merge(['today' => true])),
    //     ];
    //     return view('frontend.bill.index', $data);
    // }


    public function create(Request $request)
    {
        $data = [
            'pageTitle' => $this->moduleName,
            'savings' => $this->savingService->getAllData($request),
        ];
        return view('frontend.transactions.saving', $data);
    }

    public function store(Request $request)
    {
        $transaction['date'] =  $request->date;
        $transaction['amount'] =  $request->amount;
        $transaction['saving_id'] = $request->saving_id;
        $this->transactionService->store($transaction);
        return redirect()->route('bills.index')->with('success', 'Recorded successfully!!');
    }




 
}
