<?php

namespace App\Http\Controllers\Frontend\bill;

use App\Model\Bill;
use App\Model\Order;
use App\Model\Income;
use App\Model\Customer;
use App\Model\BillOrder;
use App\Model\FrontendUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\frontend\BillService;
use App\Services\frontend\OrderService;
use App\Services\frontend\IncomeService;
use App\Services\System\CustomerService;
use App\Services\System\BillOrderService;
use App\Exceptions\CustomGenericException;
use App\Model\PaymentMethod;
use App\Model\Transaction;
use App\Services\frontend\TransactionService;
use App\Services\System\FrontendUserService;
use App\Services\System\PaymentMethodService;
use Illuminate\Support\Facades\Redirect;

class BillController extends Controller
{
    public $orderService, $billOrderService, $frontendUser, $customerService,
        $incomeService, $billService, $paymentMethodService, $transactionService;
    public function __construct(BillService $billService)
    {
        $this->billService = $billService;
        $this->moduleName = 'Create Bill';
        $this->billOrderService = new BillOrderService(new BillOrder);
        $this->frontendUser = new FrontendUserService(new FrontendUser);
        $this->orderService = new OrderService(new Order);
        $this->customerService = new CustomerService(new Customer);
        $this->userService = new FrontendUserService(new FrontendUser);
        $this->incomeService = new IncomeService(new Income);
        $this->paymentMethodService = new PaymentMethodService(new PaymentMethod);
        $this->transactionService = new TransactionService(new Transaction());
    }

    public function index(Request $request)
    {

        $data = [
            'pageTitle' => 'Bills',
            'orders' => $this->orderService->getAllData($request->merge(['details' => 'required'])),
            'users' => $this->frontendUser->getAllData($request),
            'bills' => $this->billService->getAllData($request->merge(['today' => true])),
            'payments' =>  $this->paymentMethodService->getAllData($request),
        ];

        return view('frontend.bill.form', $data);
    }

    public function store(Request $request)
    {
        //Check if this user already exist or not
        $customerId = $this->customerService->getCustomerId($request);
        try {
            $this->billService->store($request->merge(['oldCustomer' => $customerId]));
            return redirect()->route('home')->with('success', 'Bill has been created successfully!!');
        } catch (\Exception $e) {
            dd($e);
            throw new CustomGenericException($e->getMessage());
        }
    }

    public function show($id)
    {
        $data = [
            'bill' =>  $this->billService->getBillByQr($id),
            'payments' => PaymentMethod::all(),
        ];
        $data['transaction'] = $this->transactionService->getTransactionByBill($data['bill']->id);

        return view('frontend.bill.photoBill', $data);
    }

    public function edit($id)
    {
        dd('this is edit');
    }


    public function update(Request $request, $id)
    {
        try {
            $this->billService->update($request, $id);
            return redirect()->route('home')->with('success', 'Bill has been cleared successfully!!');
        } catch (\Exception $e) {
            DB::rollback();
            throw new CustomGenericException($e->getMessage());
        }
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
