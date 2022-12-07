<?php

namespace App\Services\frontend;


use App\Model\Transaction;
use App\Services\Service;
use Carbon\Carbon;

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

    public function getTodaysTransactions()
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
        return $this->model->whereNotNull('payment_method')->where('created_at', '>=', Carbon::today())->get();
    }

    public function fetchBillData()
    {
        return $this->model->whereNotNull('bill_id')->where('created_at', '>=', Carbon::today())->get();
    }


    public function store($request)
    {
        $this->model->create($request);
        return redirect()->route('transactions.index')->with('success', 'Transaction recorded successfully!!');
    }
}
