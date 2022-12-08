<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Adjustment;
use App\Model\Bill;
use App\Model\Customer;
use App\Model\Expense;
use App\Model\FrontendUser;
use App\Model\Income;
use App\Model\Order;
use App\Model\Size;
use App\Model\Transaction;
use App\Services\frontend\ExpenseService;
use App\Services\frontend\OrderService;
use App\Services\System\AdjustmentService;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AjaxController extends Controller
{

    protected $adjustmentService, $orderService, $expenseService;
    public function __construct()
    {
        $this->adjustmentService = new AdjustmentService(new Adjustment);
        $this->orderService = new OrderService(new Order);
        $this->expenseService = new ExpenseService(new Expense);
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
            $bills = Bill::where('status', false)->whereHas('customers', function ($query) use ($request) {
                $query->where('name', 'ILIKE', '%' . $request->customer_name . '%')->orWhere('phone_number', 'ILIKE', '%' . $request->customer_name . '%');
            })->get();
            return view('frontend.bill.include.bills', compact('bills', 'totalBill', 'users'))->render();
        } elseif (isset($date)) {
            $bills = Bill::where('status', false)->where('ordered_date', 'ILIKE', '%' . $request->date . '%')->orderBy('created_at', 'DESC')->get();
            return view('frontend.bill.include.bills', compact('bills', 'totalBill', 'users'))->render();
        }
    }



    public function autocompletePhone(Request $request)
    {
        // $data = Customer::select("phone_number as value", "id")
        //     ->where('phone_number', 'ILIKE', '%' . $request->search . '%')->get();
        // return $data;

        //Search bill with the help of customer

        $data = Customer::select("phone_number as value", "id", "phone_number")
            ->where('phone_number', 'ILIKE', '%' . $request->search . '%')->get();
        return $data;
    }

    public function getIncome(Request $request)
    {
        $data['openingBalance'] =  $this->adjustmentService->getClosingBalance($request);
        $data['transactions'] = Transaction::with('bills.customers')->where('date', $request->date)->orderBy('created_at', 'DESC')->with(['bills', 'expenses', 'banks'])->get();
        $data['totalIncome'] = collect($data['transactions'])->where('bill_id')->sum('amount') + collect($data['transactions'])->where('income_id')->sum('amount');
        $data['online-payment-bill'] = collect($data['transactions'])->where('payment_method')->where('bill_id')->sum('amount');
        $data['online-payment-other'] = collect($data['transactions'])->where('payment_method')->where('income_id')->sum('amount');
        $data['totalExpense'] = collect($data['transactions'])->where('expense_id')->sum('amount');
        $data['totalSaving'] =  collect($data['transactions'])->where('saving_id')->sum('amount');
        $data['withdrawn'] = $data['transactions']->where('is_withdrawn', true)->sum('amount');
        $data['adjustment'] = Adjustment::where('date', $request->date)->first()->adjusted_amount ?? 0;



        //Calculating Total Closing Balance for selected day
        $data['closingBalance'] =  $data['openingBalance'] + $data['totalIncome'] +  $data['adjustment'] - $data['totalExpense'] - $data['totalSaving'] - $data['withdrawn'] - $data['online-payment-bill'] - $data['online-payment-other'];
        $data['todaysDate'] = $request->date;
        return view('system.home.transactions', $data);
    }


    public function getRate(Request $request)
    {
        return Order::where('id', $request->order_id)->pluck('rate')->first();
    }

    public function autoCompleteSearch(Request $request)
    {
        //Search bill with the help of customer
        $data = Customer::select("name as value", "id", "phone_number")
            ->where('name', 'ILIKE', '%' . $request->search . '%')->orWhere('phone_number', 'ILIKE', '%' . $request->search . '%')
            ->get();
        return $data;
    }

    public function getTransactionTitle(Request $request)
    {
        if ($request->transactionType === 'income') {
            $incomes =  $this->orderService->getAllData($request->merge(['details' => 'not-required']));

            $html = "<option value=''>Select Income Title</option>";
            foreach ($incomes as $income) {
                $html .= "<option value='$income->id'>$income->name</option>";
            }
            // dd($html);
        } else {
            $expenses =  $this->expenseService->getAllData($request);
            $html = "<option value=''>Select Income Title</option>";
            foreach ($expenses as $expense) {
                $html .= "<option value='$expense->id'>$expense->title</option>";
            }
        }
        return $html;
    }
}
