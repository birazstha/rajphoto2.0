<?php

namespace App\Http\Controllers\Frontend\transaction;

use App\Http\Controllers\Controller;
use App\Model\Adjustment;
use App\Model\Analytic;
use App\Model\Bill;
use App\Model\Expense;
use App\Model\FrontendUser;
use App\Model\Order;
use App\Model\PaymentMethod;
use App\Model\Size;
use App\Services\frontend\AdjustmentService;
use App\Services\frontend\AnalyticService;
use App\Services\frontend\BillService;
use App\Services\frontend\TransactionService;
use App\Services\frontend\ExpenseService;
use App\Services\System\FrontendUserService;
use App\Services\frontend\OrderService;
use App\Services\System\PaymentMethodService;
use App\Services\System\SizeService;
use Exception;
use Illuminate\Http\Request;


class TransactionController extends Controller
{
    protected $orderService,
        $frontendUser,
        $expenseService,
        $transactionService,
        $paymentMethodService,
        $adjustmentService,
        $billService,
        $analyticService,
        $sizeService;
    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
        $this->orderService = new OrderService(new Order);
        $this->frontendUser = new FrontendUserService(new FrontendUser);
        $this->expenseService = new ExpenseService(new Expense);
        $this->paymentMethodService = new PaymentMethodService(new PaymentMethod);
        $this->adjustmentService = new AdjustmentService(new Adjustment);
        $this->billService = new BillService(new Bill());
        $this->analyticService = new AnalyticService(new Analytic());
        $this->sizeService = new SizeService(new Size());
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


        $data = $request->all();
        try {
            if ($request->transaction_type === 'income') {
                $data['income_id'] = $request->transaction_title_id;
                $data['payment_gateway'] = $request->payment_gateway ?? null;
                $this->adjustmentService->updateAdjustment($request);
            } elseif ($request->transaction_type === 'expense') {
                $data['expense_id'] = $request->transaction_title_id;
                $this->adjustmentService->deductClosingBalance($request);
            }

            if (isset($request->withdrawn_amount)) {
                $data['is_withdrawn'] =  true;
                $this->adjustmentService->deductClosingBalance($request);
            }
            $data['amount'] = $request->withdrawn_amount ?? $request->amount ?? $request->total;
            $data['description'] = $request->description_income ?? $request->description_expense;
            $transactionId = $this->transactionService->store($data);



            if (!isset($request->withdrawn_amount) || $request->transaction_type != 'expense') {

                $this->analyticService->store($request->merge(['transaction' => $transactionId]));
            }

            return redirect()->route('home')->with('success', 'Expense recorded successfully!!');
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $this->transactionService->update($request, $id);
            $transaction =  $this->transactionService->itemByIdentifier($id);
            $bill = $this->billService->itemByIdentifier($request->billId);
            if ($request->transactionType === "bill") {
                $bill->update([
                    'paid_amount' => $request->amount,
                    'due_amount' => $bill->grand_total - $request->amount
                ]);
            } elseif ($request->transaction_type === "income") {
                $transaction->update([
                    'income_id' => $request->transaction_title_id,
                    'expense_id' => null
                ]);
            } elseif ($request->transaction_type === "expense") {
                $transaction->update([
                    'expense_id' => $request->transaction_title_id,
                    'income_id' => null
                ]);
            }

            //Change Transaction Type
            if ($request->payment_method === 'cash') {
                $transaction->update([
                    'payment_gateway' => null,
                ]);
            } elseif ($request->payment_method === 'online') {
                $transaction->update([
                    'payment_gateway' => $request->payment_gateway,
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

    public function income(Request $request)
    {
        $orderId = Order::where('name', 'Urgent')->first()->id;
        $data = [
            'payments' =>  $this->paymentMethodService->getAllData($request),
            'orders' => $this->orderService->getAllData($request->merge(['details' => 'not-required'])),
            'sizes' => $this->sizeService->getAllData($request->merge(['urgentId' => $orderId]))
        ];
        return view('frontend.transactions.income', $data);
    }

    public function expense(Request $request)
    {
        $data = [
            'expenses' => $this->expenseService->getAllData($request),
            'transactions' => $this->transactionService->getExpenses($request),
        ];
        return view('frontend.transactions.expense', $data);
    }
}
