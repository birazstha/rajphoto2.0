<?php

namespace App\Http\Controllers\Frontend\expense;

use App\Exceptions\CustomGenericException;
use App\Http\Controllers\Controller;
use App\Model\Bill;
use App\Model\Transaction;
use App\Services\frontend\ExpenseService;
use App\Services\frontend\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    protected $expenseService, $transactionService;
    public function __construct(ExpenseService $expenseService)
    {
        $this->expenseService = $expenseService;
        $this->moduleName = 'Create Bill';
        $this->transactionService = new TransactionService(new Transaction);
    }

    public function index(Request $request)
    {
        $data = [
            'pageTitle' => 'Bills',
            'bills' => $this->billService->getAllData($request->merge(['today' => true])),
        ];
        return view('frontend.bill.index', $data);
    }


    public function create(Request $request)
    {
        $data = [
            'pageTitle' => $this->moduleName,
            'orders' => $this->orderService->getAllData($request->merge(['details'=>'not-required'])),
            'users' => $this->frontendUser->getAllData($request),
        ];
        return view('frontend.bill.other-income', $data);
    }

    public function store(Request $request)
    {
        $transaction['date'] =  $request->date;
        $transaction['amount'] =  $request->amount;
        $transaction['expense_id'] = $request->expense_id;
        $transaction['description'] = $request->description;
        $this->transactionService->store($transaction);
        return redirect()->route('transactions.index')->with('success', 'Transaction recorded successfully!!');
    }


    public function show($id)
    {
        $data['row'] = Bill::where('id', $id)->first();
        return view('frontend.bill.photoBill', compact('data'));
    }


    public function edit($id)
    {
        dd('this is edit');
    }


    public function update(Request $request, $id)
    {
        try {
            $income['amount'] =  $request->total;
            $income['date'] =  $request->cleared_date;
            $income['type'] =  'deliver';
            
            $this->billService->update($request, $id);
            $this->incomeService->store($income);


            return redirect()->route('bills.index');
        } catch (\Exception $e) {
            DB::rollback();
            throw new CustomGenericException($e->getMessage());
        }
    }

    public function destroy($id)
    {
    }

    public function scanQrCode()
    {
        return view('frontend.bill.qrcode');
    }

    public function searchBill(Request $request)
    {


        $items = Bill::where('qr_code', $request->qrcode)->first();
        $data = [
            'item' => $items,
            'orders' => $this->orderService->getAllData($request),
            'sizes' => $this->orderService->getAllData($request),
            'users' => $this->frontendUser->getAllData($request),
        ];
        return view('frontend.bill.form', $data);
    }

    public function searchBillFromIndex(Request $request, $qr_code)
    {
        $items = Bill::where('qr_code', $qr_code)->first();
        $data = [
            'item' => $items,
            'orders' => $this->orderService->getAllData($request),
            'sizes' => $this->orderService->getAllData($request),
            'users' => $this->frontendUser->getAllData($request),
        ];
        return view('frontend.bill.form', $data);
    }
}
