<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Bill;
use App\Model\Customer;
use App\Model\FrontendUser;
use App\Model\Income;
use App\Model\Order;
use App\Model\Size;
use App\User;
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
        $users = FrontendUser::all();
        $date =  $request->date;
        if (isset($customerName)) {
            $customers = Customer::where('phone_number', 'ILIKE', '%' . $request->customer_name . '%')->orWhere('name', 'ILIKE', '%' . $request->customer_name . '%')->get();
            return view('frontend.bill.include.billsByCustomer', compact('customers', 'totalBill','users'))->render();
        } elseif (isset($date)) {
            $bills = Bill::where('ordered_date', 'ILIKE', '%' . $request->date . '%')->orderBy('created_at', 'DESC')->paginate(10);
            return view('frontend.bill.include.billsByDate', compact('bills', 'totalBill','users'))->render();
        }
    }

    public function autocompletePhone(Request $request)
    {
        $data = Customer::select("phone_number as value", "id")
            ->where('phone_number', 'ILIKE', '%' . $request->get('search') . '%')
            ->get();
        return response()->json($data);

        // $data = $request->all();
        // $query = $data['query'];
        // $filter_data = Customer::where('customer_id', 'ILIKE', '%' . $query . '%')
        //     ->get();
        // return response()->json($filter_data);
    }

    public function autocompleteName(Request $request)
    {      
        $data = $request->all();
        $query = $data['query'];
        $filter_data = Customer::where('name', 'ILIKE', '%' . $query . '%')
            ->get();
        return response()->json($filter_data);
    }

    public function getIncome(Request $request){
        $income = Income::where('date',$request->date)->get();
        return view('system.home.income', compact('income'))->render();
     
    }
}