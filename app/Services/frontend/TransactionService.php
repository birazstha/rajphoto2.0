<?php

namespace App\Services\frontend;


use Carbon\Carbon;
use App\Model\BillOrder;
use App\Services\Service;
use App\Model\Transaction;
use Illuminate\Support\Facades\DB;

class TransactionService extends Service
{
    protected $orderService, $frontendUser;
    public function __construct(Transaction $bill)
    {
        parent::__construct($bill);
        $this->module = 'Prepare Bill';
    }

    public function getAllData($data, $selectedColumns = [], $pagination = true)
    {
        $query = $this->query();
        if (isset($data->keyword) && $data->keyword !== null) {
            $query->where('name', 'ILIKE', '%' . $data->keyword . '%');
        }
        if (count($selectedColumns) > 0) {
            $query->select($selectedColumns);
        }

        return $query->orderBy('created_at', 'DESC')->where('created_at', '>=', Carbon::today())->whereNull(['saving_id', 'bill_id'])->where('is_withdrawn', false)->paginate(10);
    }



    public function getTodaysTransactionsTest()
    {

        // return DB::table('bill_orders')

        //     // ->select(DB::raw("(sum(transactions.amount)) as total_amount"))
        //     // ->select('sizes.name as size_name', 'orders.name')
        //     ->join('orders', 'bill_orders.order_id', '=', 'orders.id')
        //     ->join('sizes', 'bill_orders.size_id', '=', 'sizes.id')
        //     ->join('transactions', 'bill_orders.bill_id', '=', 'transactions.bill_id')
        //     // ->groupBy('bill_orders.size_id')
        //     ->get();
        // // return BillOrder::select('size_id')->groupBy('size_id')->get();

        // return $this->model->select(
        //     DB::raw("(sum(amount)) as total_amount"),
        //     'income_id',
        //     DB::raw("count(income_id)")
        // )
        //     ->where('created_at', '>=', Carbon::today())
        //     // ->orderBy('date')
        //     ->groupBy('income_id')
        //     ->get();

        return $this->model->select(DB::raw('amount'))->where('created_at', '>=', Carbon::today())->orderBy('created_at', 'DESC')->with(['bills', 'expenses', 'banks'])->get()->groupBy('date');
    }

    public function getTodaysTransactionsAjax($request)
    {
        return $this->model->where('date', '=', $request->date)->orderBy('created_at', 'DESC')->with(['bills', 'expenses', 'banks'])->get();
    }

    public function getTodaysTransactions($request)
    {
        return $this->model->where('created_at', '>=', Carbon::today())->orderBy('created_at', 'DESC')->with(['bills', 'expenses', 'banks'])->get();
    }

    public function getSavingsDetail()
    {
        $query = $this->query();
        return $query->orderBy('created_at', 'DESC')->where('created_at', '>=', Carbon::today())->whereNotNull('saving_id')->get();
    }

    public function fetchIncomeData()
    {
        return $this->model->whereNotNull('income_id')->where('created_at', '>=', Carbon::today())->get();
    }

    public function fetchExpenseData()
    {
        return $this->model->whereNotNull('expense_id')->where('created_at', '>=', Carbon::today())->get();
    }

    public function fetchSavingData()
    {
        return $this->model->whereNotNull('saving_id')->where('created_at', '>=', Carbon::today())->get();
    }

    public function fetchOnlinePaymentData()
    {
        return $this->model->whereNotNull('payment_gateway')->where('created_at', '>=', Carbon::today())->get();
    }

    public function fetchBillData()
    {
        return $this->model->whereNotNull('bill_id')->where('created_at', '>=', Carbon::today())->get();
    }


    public function store($request)
    {
        $transaction = $this->model->create($request);
        return $transaction->id;
    }

    public function getTransactionByBill($id)
    {
        return $this->model->where('bill_id', $id)->first();
    }

    public function getTransactionAmount()
    {
        $transaction =  $this->model->where('created_at', '>=', Carbon::today())->get();
        return  collect($transaction)->whereNOtNull('bill_id')->sum('amount');
    }

    public function getExpenses()
    {
        return $this->model->whereNotNull('expense_id')->where('created_at', '>=', Carbon::today())->get();
    }
}
