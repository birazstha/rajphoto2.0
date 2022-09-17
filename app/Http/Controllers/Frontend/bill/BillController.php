<?php

namespace App\Http\Controllers\Frontend\bill;

use App\Exceptions\CustomGenericException;
use App\Http\Controllers\Controller;
use App\Model\Bill;
use App\Model\BillOrder;
use App\Model\Customer;
use App\Model\FrontendUser;
use App\Model\Income;
use App\Model\Order;
use App\Services\frontend\IncomeService;
use App\Services\frontend\OrderService;
use App\Services\System\BillOrderService;
use App\Services\System\BillService;
use App\Services\System\CustomerService;
use App\Services\System\FrontendUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    protected $orderService, $billOrderService, $frontendUser, $customerService, $incomeService, $billService;
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
            'orders' => $this->orderService->getAllData($request),
            'users' => $this->frontendUser->getAllData($request),
        ];
        return view('frontend.bill.form', $data);
    }

    public function store(Request $request)
    {
        //Urgent Order value is 4
        $orderType = $request->bill[0]['order_id'];
        try {
            $data = $request;
            $data['qr_code'] = uniqid();
            if ($orderType == 4) {
                $data['cleared_date'] =  $request->ordered_date;
                $data['cleared_by'] =  $request->user_id;
                $data['status'] = true;
            }
            $customerId = uniqid();
            $customer = $this->customerService->store($request->merge(['customer_id' => $customerId]));
            //Storing icome amount
            $data['customer_id'] = $customer->id;
           
            //For storing income amount
            $income['amount'] =  $request->paid_amount;
            $income['date'] =  $request->ordered_date;
            $income['type'] =  'order';
            $this->incomeService->store($income);

            // Bill Create Operation
            $bill = $this->billService->store($data); 

            //Storing multiple orders 
            $this->billOrderService->store($request->merge(['bill_id' => $bill->id]));
            if ($bill) {
                return redirect()->route('bills.show', $bill->id);
            }
        } catch (\Exception $e) {
            DB::rollback();
            throw new CustomGenericException($e->getMessage());
        }
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
        // dd($request->all());
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
