<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Bill;
use App\Model\Customer;
use App\Model\Order;
use App\Model\Size;

use Illuminate\Http\Request;

class TestController extends Controller
{


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
        return $size->rate;
    }

    public function getCustomerInfo(Request $request)
    {
        $customerName =  $request->customer_name;
        $totalBill =  Bill::count();
        $date =  $request->date;
        if (isset($customerName)) {
            $customers = Customer::where('name', 'ILIKE', '%' . $request->customer_name . '%')->paginate(10);
            return view('frontend.bill.include.billsByCustomer', compact('customers', 'totalBill'))->render();
        } elseif (isset($date)) {

            $bills = Bill::where('ordered_date', 'ILIKE', '%' . $request->date . '%')->orderBy('created_at', 'DESC')->paginate(10);
            return view('frontend.bill.include.billsByDate', compact('bills', 'totalBill'))->render();
        }
    }

    public function autocomplete(Request $request)
    {
        $data = Customer::select("name as value", "id")
            ->where('name', 'ILIKE', '%' . $request->get('search') . '%')
            ->get();

        return response()->json($data);
    }
}
