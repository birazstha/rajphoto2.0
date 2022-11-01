<?php

namespace App\Http\Controllers\Frontend\transaction;
use App\Http\Controllers\Controller;
use App\Model\Expense;
use App\Model\FrontendUser;
use App\Model\Order;
use App\Services\frontend\TransactionService;
use App\Services\System\ExpenseService;
use App\Services\System\FrontendUserService;
use App\Services\System\OrderService;
use Illuminate\Http\Request;


class TransactionController extends Controller
{
    protected $orderService,$frontendUser,$expenseService,$transactionService;
     public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
        $this->orderService = new OrderService(new Order);
        $this->frontendUser = new FrontendUserService(new FrontendUser);
        $this->expenseService = new ExpenseService(new Expense);

    }

    public function index(Request $request)
    {
        $data = [
            'orders' => $this->orderService->getAllData($request->merge(['details' => 'not-required'])),
            'users' => $this->frontendUser->getAllData($request),
            'expenses' => $this->expenseService->getAllData($request),
            'transactions'=>$this->transactionService->getAllData($request),
            'pageTitle'=>'Transaction'

        ];
        return view('frontend.transactions.index', $data);
    }

}