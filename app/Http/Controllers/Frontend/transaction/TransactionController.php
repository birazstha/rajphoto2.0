<?php

namespace App\Http\Controllers\Frontend\transaction;
use App\Http\Controllers\Controller;
use App\Model\FrontendUser;
use App\Model\Order;
use App\Services\frontend\TransactionService;
use App\Services\System\FrontendUserService;
use App\Services\System\OrderService;
use Illuminate\Http\Request;


class TransactionController extends Controller
{
    protected $orderService,$frontendUser;
     public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
        $this->orderService = new OrderService(new Order);
        $this->frontendUser = new FrontendUserService(new FrontendUser);

    }

    public function index(Request $request)
    {
        $data = [
            'pageTitle' => 'Bills',
           
        ];
        return view('frontend.bill.index', $data);
    }


    public function create(Request $request)
    {
        $data = [
            'orders' => $this->orderService->getAllData($request->merge(['details' => 'not-required'])),
            'users' => $this->frontendUser->getAllData($request),
    

        ];
        return view('frontend.transactions.form', $data);
    }

    public function store(Request $request)
    {
        $this->transactionService->store($request);
        return redirect()->route('bills.index')->with('success', 'Recorded successfully!!');
    }


    public function show($id)
    {
        $data['row'] = Bill::where('id', $id)->first();
        return view('frontend.bill.photoBill', compact('data'));
    }


   

}
