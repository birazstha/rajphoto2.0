<?php

namespace App\Http\Controllers\Frontend\transaction;

use App\Http\Controllers\Controller;
use App\Model\Adjustment;
use App\Model\Bill;
use App\Model\Expense;
use App\Model\FrontendUser;
use App\Model\Order;
use App\Model\PaymentMethod;
use App\Services\frontend\AdjustmentService;
use App\Services\frontend\BillService;
use App\Services\frontend\TransactionService;
use App\Services\frontend\ExpenseService;
use App\Services\System\FrontendUserService;
use App\Services\frontend\OrderService;
use App\Services\System\PaymentMethodService;
use Exception;
use Illuminate\Http\Request;


class TransactionController extends Controller
{
    protected $orderService, $frontendUser, $expenseService, $transactionService, $paymentMethodService, $adjustmentService, $billService;
    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
        $this->orderService = new OrderService(new Order);
        $this->frontendUser = new FrontendUserService(new FrontendUser);
        $this->expenseService = new ExpenseService(new Expense);
        $this->paymentMethodService = new PaymentMethodService(new PaymentMethod);
        $this->adjustmentService = new AdjustmentService(new Adjustment);
        $this->bill = new Bill();
    }

    public function index(Request $request)
    {
        $data = [
            'pageTitle' => 'Transaction',
            'orders' => $this->orderService->getAllData($request->merge(['details' => 'not-required'])),
            'users' => $this->frontendUser->getAllData($request),
            'expenses' => $this->expenseService->getAllData($request),
            'transactions' => $this->transactionService->getAllData($request),
            'payments' =>  $this->paymentMethodService->getAllData($request),
        ];
        return view('frontend.transactions.index', $data);
    }

    public function store(Request $request)
    {
        if ($request->transaction_type === 'income') {
            $data['income_id'] = $request->transaction_title_id;
            $data['payment_method'] = $request->payment_method ?? null;
            $this->adjustmentService->updateAdjustment($request);
        } elseif ($request->transaction_type === 'expense') {
            $data['expense_id'] = $request->transaction_title_id;
            $this->adjustmentService->deductClosingBalance($request);
        }

        if (isset($request->withdrawn_amount)) {
            $data['is_withdrawn'] =  true;
            $this->adjustmentService->deductClosingBalance($request);
        }
        $data['amount'] = $request->withdrawn_amount ?? $request->total ?? $request->amount;
        $data['date'] =  $request->date;
        $this->transactionService->store($data);
        return redirect()->back()->with('success', 'Recorded successfully!!');
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        try {
            $this->transactionService->update($request, $id);
            if ($request->transactionType === "bill") {
                $bill = $this->bill->where('id', $request->billId)->first();
                $bill->update([
                    'paid_amount' => $request->amount,
                    'due_amount' => $bill->grand_total - $request->amount
                ]);
            }
            return redirect()->back()->with('success', 'Updated successfully!!');
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function destroy(Request $request, $id)
    {
        $this->transactionService->delete($request, $id);
        return redirect()->back()->with('success', 'Deleted successfully!!');
    }
}
