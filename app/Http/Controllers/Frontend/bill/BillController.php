<?php

namespace App\Http\Controllers\Frontend\bill;

use App\Http\Controllers\Controller;
use App\Model\Bill;
use App\Model\BillOrder;
use App\Model\Order;
use App\Services\frontend\OrderService;
use Illuminate\Http\Request;

class BillController extends Controller
{
    protected $orderService;
    public function __construct()
    {
        $this->orderService = new OrderService(new Order);
    }

    public function index()
    {
        //
    }


    public function create(Request $request)
    {

        $data = [
            'orders' => $this->orderService->getAllData($request),
        ];
        return view('frontend.bill.form', $data);
    }


    public function store(Request $request)
    {
        $data = $request->except(['_token', 'order_id', 'size_id', 'rate', 'quantity', 'total']);
        $data['qr_code'] = uniqid();
        $data['row'] =  Bill::create($data);

        //Storing multiple orders detail
        if ($data['row']) {
            $billOrder['bill_id'] = $data['row']->id;
            $orders = $request->input('order_id');
            $sizes = $request->input('size_id');
            $quantities = $request->input('quantity');
            $rates = $request->input('rate');
            $totals = $request->input('total');

            for($i = 0; $i < count($orders); $i++){
                $billOrder['order_id'] = $orders[$i];
                $billOrder['size_id'] = $sizes[$i];
                $billOrder['quantity'] = $quantities[$i];
                $billOrder['rate'] = $rates[$i];
                $billOrder['total'] = $totals[$i];
                BillOrder::create($billOrder);
            }
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
        ];
        return view('frontend.bill.form',$data);
    }
}
