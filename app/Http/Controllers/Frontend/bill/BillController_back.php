<?php

namespace App\Http\Controllers\Frontend\bill;

use App\Exceptions\CustomGenericException;
use App\Http\Controllers\Controller;
use App\Http\Controllers\System\ResourceController;
use App\Model\Bill;
use App\Model\BillOrder;
use App\Model\Order;
use App\Services\System\BillOrderService;
use App\Services\System\BillService;
use App\Services\System\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    protected $orderService;
    public function __construct(BillService $billService)
    {
        $this->orderService = new OrderService(new Order);
    }

    // public function storeValidationRequest()
    // {   
    //     return 'App\Http\Requests\system\billRequest';
    // }

    // public function updateValidationRequest()
    // {
    //     return 'App\Http\Requests\system\billRequest';
    // }

    public function moduleName()
    {
        return 'bills';
    }

    public function viewFolder()
    {
        return 'frontend.bill';
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
        ];
        return view('frontend.bill.form',$data);
    }

    public function show($id)
    {
       $data['row'] = Bill::where('id',$id)->first();
       return view('frontend.bill.photoBill',compact('data'));

    }

    public function store(Request $request)
    {
        try{
            $data = $request->except('_token');
            $data['qr_code'] = uniqid();
            $bill = $this->model->create($data); // Bill Create Operation+
            (new BillOrderService(new BillOrder()))->store($request->merge(['bill_id'=>$bill->id]));  
            if($bill){
                return redirect()->route('bills.show',$bill->id);
            }
        }catch(\Exception $e){
           throw new CustomGenericException($e->getMessage());
           dd($e);
        }
      
    }

   

   
}
