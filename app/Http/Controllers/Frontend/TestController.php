<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Bill;
use App\Model\Customer;
use App\Model\FrontendUser;
use App\Model\Income;
use App\Model\Order;
use App\Model\Size;
use App\Model\Transaction;
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
            return view('frontend.bill.include.billsByCustomer', compact('customers', 'totalBill', 'users'))->render();
        } elseif (isset($date)) {
            $bills = Bill::where('ordered_date', 'ILIKE', '%' . $request->date . '%')->orderBy('created_at', 'DESC')->paginate(10);
            return view('frontend.bill.include.billsByDate', compact('bills', 'totalBill', 'users'))->render();
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
    
        //Closing Balance
        $data['transactions'] = Transaction::where('date', $request->date)->orderBy('created_at', 'DESC')->with(['bills', 'expenses', 'savings'])->get();
        $data['totalIncome'] = collect($data['transactions'])->where('bill_id')->sum('amount') + collect($data['transactions'])->where('income_id')->sum('amount');
        $data['totalExpense'] = collect($data['transactions'])->where('expense_id')->sum('amount');
        $data['totalSaving'] =  collect($data['transactions'])->where('saving_id')->sum('amount');

     


        //Opening Balance
        $data['transactions_opening'] = Transaction::where('date', $request->prevDate)->orderBy('created_at', 'DESC')->with(['bills', 'expenses', 'savings'])->get();
        $data['totalIncomeClosing'] = collect($data['transactions_opening'])->where('bill_id')->sum('amount') + collect($data['transactions_opening'])->where('income_id')->sum('amount');
        $data['totalExpenseClosing'] = collect($data['transactions_opening'])->where('expense_id')->sum('amount');
        $data['totalSavingClosing'] =  collect($data['transactions_opening'])->where('saving_id')->sum('amount');

        $data['openingBalance'] =  $data['totalIncomeClosing'] - $data['totalExpenseClosing'] - $data['totalSavingClosing'];


        $data['withdrawn'] = $data['transactions']->where('is_withdrawn',true)->sum('amount');
    

        $data['closingBalance'] =  $data['openingBalance'] +  $data['totalIncome'] - $data['totalExpense'] - $data['totalSaving'] - $data['withdrawn'];


       

        return view('system.home.transactions', $data)->render();
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
