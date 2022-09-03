<?php

namespace App\Http\Controllers\Frontend\bill;

use App\Exceptions\CustomGenericException;
use App\Http\Controllers\Controller;
use App\Model\Bill;
use App\Model\BillOrder;
use App\Model\FrontendUser;
use App\Model\Order;
use App\Services\frontend\OrderService;
use App\Services\System\BillOrderService;
use App\Services\System\BillService;
use App\Services\System\FrontendUserService;
use Illuminate\Http\Request;

class BillController extends Controller
{
    protected $orderService,$billOrderService,$frontendUser;
    public function __construct(BillService $billService)
    {
        $this->billService = $billService;
        $this->moduleName = 'Create Bill';
        $this->billOrderService = new BillOrderService(new BillOrder);
        $this->frontendUser = new FrontendUserService(new FrontendUser);
        $this->orderService = new OrderService(new Order);
    }

    public function index(Request $request)
    {
        
        $data = [
            'pageTitle' => $this->moduleName,
            'bills' =>$this->billService->getAllData($request),
        ];
        return view('frontend.bill.index', $data);
    }


    public function create(Request $request)
    {

        $data = [
            'pageTitle' => $this->moduleName,
            'orders' => $this->orderService->getAllData($request),
            'users'=>$this->frontendUser->getAllData($request),
        ];
        return view('frontend.bill.form', $data);
    }

    public function store(Request $request)
    {
        try{
            $data = $request;
            $data['qr_code'] = uniqid();
            $bill = $this->billService->store($data); // Bill Create Operation+
            $this->billOrderService->store($request->merge(['bill_id'=>$bill->id]));  
            if($bill){
                return redirect()->route('bills.show',$bill->id);
            }
        }catch(\Exception $e){
           throw new CustomGenericException($e->getMessage());
        }
    }


    public function show($id)
    {
       $data['row'] = Bill::where('id',$id)->first();
       return view('frontend.bill.photoBill',compact('data'));

    }

   
    public function edit($id)
    {
       dd('hello');
    }

   
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {

    }

    public function scanQrCode(){
        return view('frontend.bill.qrcode');
    }

    public function searchBill(Request $request){

        $items = Bill::where('qr_code',$request->qrcode)->first();
        $data = [
            'item' => $items,
            'orders' => $this->orderService->getAllData($request),
            'sizes' => $this->orderService->getAllData($request),
            'users'=>$this->frontendUser->getAllData($request),
        ];
        return view('frontend.bill.form',$data);
    }

    public function searchBillFromIndex(Request $request,$qr_code){
        $items = Bill::where('qr_code',$qr_code)->first();
        $data = [
            'item' => $items,
            'orders' => $this->orderService->getAllData($request),
            'sizes' => $this->orderService->getAllData($request),
            'users'=>$this->frontendUser->getAllData($request),
        ];
        return view('frontend.bill.form',$data);
    }
}
