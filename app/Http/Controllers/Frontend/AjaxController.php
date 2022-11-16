<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Adjustment;
use App\Model\Bill;
use App\Model\Customer;
use App\Model\FrontendUser;
use App\Model\Income;
use App\Model\Order;
use App\Model\Size;
use App\Model\Transaction;
use App\Services\System\AdjustmentService;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AjaxController extends Controller
{

    protected $adjustmentService;
    public function __construct()
    {
        $this->adjustmentService = new AdjustmentService(new Adjustment);
    }


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
            // $customers = Customer::where('phone_number', 'ILIKE', '%' . $request->customer_name . '%')->orWhere('name', 'ILIKE', '%' . $request->customer_name . '%')->get();
          

            $bills = Bill::whereHas('customers', function ($query) use ($request) {
                $query->where('name', 'ILIKE','%'. $request->customer_name.'%')->orWhere('phone_number', 'ILIKE', '%' . $request->customer_name . '%');
            })->get();
            return view('frontend.bill.include.bills', compact('bills', 'totalBill', 'users'))->render();
        } elseif (isset($date)) {
            $bills = Bill::where('ordered_date', 'ILIKE', '%' . $request->date . '%')->orderBy('created_at', 'DESC')->paginate(5);
            return view('frontend.bill.include.bills', compact('bills', 'totalBill', 'users'))->render();
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

    public function getIncome(Request $request)
    { 
        $data['openingBalance'] =  $this->adjustmentService->getClosingBalance($request);   
        $data['transactions'] = Transaction::where('date', $request->date)->orderBy('created_at', 'DESC')->with(['bills', 'expenses', 'savings'])->get();
        $data['totalIncome'] = collect($data['transactions'])->where('bill_id')->sum('amount') + collect($data['transactions'])->where('income_id')->sum('amount');
        $data['online-payment'] = collect($data['transactions'])->where('payment_method')->where('bill_id')->sum('amount');
        $data['totalExpense'] = collect($data['transactions'])->where('expense_id')->sum('amount');
        $data['totalSaving'] =  collect($data['transactions'])->where('saving_id')->sum('amount');
        $data['withdrawn'] = $data['transactions']->where('is_withdrawn',true)->sum('amount');
        $data['adjustment'] = Adjustment::where('date',$request->date)->first()->adjusted_amount ?? 0; 
     

        //Calculating Total Closing Balance for selected day
        $data['closingBalance'] =  $data['openingBalance'] + $data['totalIncome'] +  $data['adjustment'] - $data['totalExpense'] - $data['totalSaving'] - $data['withdrawn'] - $data['online-payment'];
        $data['todaysDate'] = $request->date;
        return view('system.home.transactions', $data);
    }

    public function getOpeningBalance(Request $request)
    {
        $data['openingBalance'] = 100;
    }


    public function getRate(Request $request)
    {
        return Order::where('id', $request->order_id)->pluck('rate')->first();
    }
}
