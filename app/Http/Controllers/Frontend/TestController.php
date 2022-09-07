<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Bill;
use App\Model\Order;
use App\Model\Size;
use App\Traits\BillTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TestController extends Controller
{
    use BillTrait;
    
    public function getOrderById(Request $request)
    {

        $order = Order::find($request->input('order_id'));
        $html = "<option value=''>Select a size</option>";
        foreach ($order->sizes as $size) {
            $html .= "<option value='$size->id'>$size->name</option>";
        }
        return $html;
    }

    public function getRateBySize(Request $request)
    {
        $size = Size::find($request->input('size_id'));
        // dd($size);
        return $size->rate;
    }

    public function getCustomerInfo(Request $request)
    {

        if ($request->customer_name) {
            $customerDetail = Bill::where('name', 'ILIKE', '%' . $request->customer_name . '%')->with('users')->paginate(10);
            return response()->json([
                $customerDetail
            ]);

        } else {
            $customerDetail = Bill::where('ordered_date', 'ILIKE', '%' . $request->date . '%')->with('users')->orderBy('created_at','DESC')->paginate(10);
            return response()->json([
                $customerDetail
            ]);

        }
    }

    public function darkmode(Request $request){
        // if($request->btnName==='dark'){
        //     Session::put('darkStatus',1);
        // }else{
        //     Session::put('darkStatus',0);
        // }
    }
}
