<?php

namespace App\Http\Controllers\Frontend\bank;


use App\Http\Controllers\Controller;
use App\Model\Transaction;
use App\Services\frontend\SavingService;
use App\Services\frontend\TransactionService;
use Illuminate\Http\Request;

class BankController extends Controller
{
    protected $expenseService, $transactionService;
    public function __construct(SavingService $savingService)
    {
        $this->savingService = $savingService;
        $this->moduleName = 'Savings';
        $this->transactionService = new TransactionService(new Transaction);
    }

    public function index(Request $request)
    {
        $data = [
            'pageTitle' => $this->moduleName,
            'savings' => $this->transactionService->getSavingsDetail($request),
            'banks' => $this->savingService->getAllData($request),
        ];
        return view('frontend.saving.index', $data);
    }

    public function store(Request $request)
    {
        $transaction['date'] =  $request->date;
        $transaction['amount'] =  $request->amount;
        $transaction['saving_id'] = $request->saving_id;
        $this->transactionService->store($transaction);
        return redirect()->route('bank.index')->with('success', 'Recorded successfully!!');
    }
}
