<?php

namespace App\Services\frontend;

use App\Exceptions\CustomGenericException;
use App\Model\Bill;
use App\Model\BillOrder;
use App\Model\Customer;
use App\Model\Income;
use App\Model\Order;
use App\Services\frontend\IncomeService;
use App\Services\Service;
use App\Services\System\BillOrderService;
use App\Services\System\CustomerService;
use Illuminate\Support\Facades\DB;

class BillService extends Service
{

    protected $orderService, $frontendUser;
    public function __construct(Bill $bill)
    {
        parent::__construct($bill);
        $this->orderService = new OrderService(new Order);
        $this->incomeService = new IncomeService(new Income);
        $this->billOrderService = new BillOrderService(new BillOrder);
        $this->customerService = new CustomerService(new Customer);



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

        if (isset($data->order_id)) {
            return $query->where('order_id', $data->order_id)->paginate(PAGINATE);
        }

        if ($pagination) {
            return $query->orderBy('id', 'ASC')->paginate(PAGINATE);
        }
        return $query->orderBy('id', 'ASC')->get();
    }

    public function store($request)
    {
        //Urgent Order value is 4
        $orderType = $request->bill[0]['order_id'];
        try {
            $data = $request->all();
            $data['qr_code'] = uniqid();
            if ($orderType == 4) {
                $data['cleared_date'] =  $request->ordered_date;
                $data['cleared_by'] =  $request->user_id;
                $data['status'] = true;
            }
            $customerId = uniqid();
            $customer = $this->customerService->store($request->merge(['customer_id' => $customerId]));
            //Storing icome amount
            $data['customer_id'] = $customer->id;

            //For storing income amount
            $income['amount'] =  $request->paid_amount;
            $income['date'] =  $request->ordered_date;
            $income['type'] =  'order';
            $this->incomeService->store($income);

            // Bill Create Operation
            $bill = $this->model->create($data);

            //Storing multiple orders
            $this->billOrderService->store($request->merge(['bill_id' => $bill->id]));

            return $bill;
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            throw new CustomGenericException($e->getMessage());
        }
    }

    public function update($request, $id)
    {
        try {

            $item = $this->itemByIdentifier($id);
            $data['status'] = true;
            $data['cleared_by'] = $request->user_id;
            $data['cleared_date'] = $request->cleared_date;
            $data['cash_received'] = $request->cash_received;
            $data['cash_return'] = $request->cash_return;
            $item = $this->itemByIdentifier($id);
            $item->update($data);

            //For storing Income
            $income['amount'] =  $request->total;
            $income['date'] =  $request->cleared_date;
            $income['type'] =  'deliver';
            $this->incomeService->store($income);

            return $item;
        } catch (\Exception $e) {
            dd($e);
            throw new CustomGenericException($e->getMessage());
        }
    }


    public function createPageData($request)
    {

        return [
            'orders' => $this->orderService->getAllData($request->merge(['pluck' => true])),
            'users' => $this->frontendUser->getAllData($request),
            'status' => $this->status(),
            'order_id' => $request->order_id,
            'pageTitle' => $this->module,

        ];
    }


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
