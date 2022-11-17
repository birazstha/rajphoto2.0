<?php

namespace App\Http\Controllers\Frontend\transaction;
use App\Http\Controllers\Controller;
use App\Model\Expense;
use App\Model\FrontendUser;
use App\Model\Order;
use App\Model\PaymentMethod;
use App\Services\frontend\TransactionService;
use App\Services\System\ExpenseService;
use App\Services\System\FrontendUserService;
use App\Services\System\OrderService;
use App\Services\System\PaymentMethodService;
use Illuminate\Http\Request;


class TransactionController extends Controller
{
    protected $orderService,$frontendUser,$expenseService,$transactionService,$paymentMethodService;
     public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
        $this->orderService = new OrderService(new Order);
        $this->frontendUser = new FrontendUserService(new FrontendUser);
        $this->expenseService = new ExpenseService(new Expense);
        $this->paymentMethodService = new PaymentMethodService(new PaymentMethod);

    }

    public function index(Request $request)
    {

        $data = [
            'pageTitle'=>'Transaction',
            'orders' => $this->orderService->getAllData($request->merge(['details' => 'not-required'])),
            'users' => $this->frontendUser->getAllData($request),
            'expenses' => $this->expenseService->getAllData($request),
            'transactions'=>$this->transactionService->getAllData($request),
            'payments'=>  $this->paymentMethodService->getAllData($request),

        ];
        return view('frontend.transactions.index', $data);
    }

    public function store(Request $request){
        $data['is_withdrawn'] =  true;
        $data['amount'] = $request->withdrawn_amount;
        $data['date'] =  $request->date;
        $this->transactionService->store($data);
        return redirect()->back()->with('success', 'Recorded successfully!!');
    }

}
