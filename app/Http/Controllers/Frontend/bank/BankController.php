<?php

namespace App\Http\Controllers\Frontend\bank;


use App\Http\Controllers\Controller;
use App\Model\Saving;
use App\Model\Transaction;
use App\Services\frontend\SavingService;
use App\Services\frontend\TransactionService;
use Illuminate\Http\Request;

class BankController extends Controller
{
    protected $expenseService, $transactionService, $moduleName, $savingService;
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
            'bank' => Saving::where('id', $request->bankId)->first(),
        ];
        return view('frontend.saving.form', $data);
    }

    public function store(Request $request)
    {
        $transaction['date'] =  $request->date;
        $transaction['amount'] =  $request->amount;
        $transaction['saving_id'] = $request->saving_id;
        $this->transactionService->store($transaction);
        return redirect()->route('home')->with('success', 'Recorded successfully!!');
    }
}
