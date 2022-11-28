<?php

namespace App\Services\frontend;

use App\Model\Expense;
use App\Model\Income;
use App\Model\Order;
use App\Services\frontend\IncomeService;
use App\Services\Service;

class ExpenseService extends Service
{
    protected $orderService, $frontendUser;
    public function __construct(Expense $bill)
    {
        parent::__construct($bill);
        $this->orderService = new OrderService(new Order);
        $this->incomeService = new IncomeService(new Income);

        $this->module = 'Prepare Bill';
    }

    public function getAllData($data, $selectedColumns = [], $pagination = true)
    {
        $query = $this->query();
        if (isset($data->keyword) && $data->keyword !== null) {
            $query->where('name', 'ILIKE', '%' . $data->keyword . '%');
        }
        
        return $query->orderBy('id', 'ASC')->get();
    }

    public function store($request)
    {
        $income['amount'] =  $request->total;
        $income['date'] =  $request->date;
        $income['type'] =  'other';
        $this->incomeService->store($income);
        return $this->model->create($request->except('_token'));
    }



    // public function createPageData($request)
    // {
    //     return [
    //         'orders' => $this->orderService->getAllData($request->merge(['pluck' => true])),
    //         'users' => $this->frontendUser->getAllData($request),
    //         'status' => $this->status(),
    //         'order_id' => $request->order_id,
    //         'pageTitle' => $this->module,

    //     ];
    // }


    public function editPageData($request, $id)
    {
        return [
            'item' => $this->itemByIdentifier($id),
            'orders' => $this->orderService->getAllData($request->merge(['pluck' => true])),
            'status' => $this->status(),
            'order_id' => $request->order_id,
        ];
    }



    public function indexPageData($request)
    {
        return [
            'items' => $this->getAllData($request),
            'order_id' => $request->order_id,
        ];
    }
}
