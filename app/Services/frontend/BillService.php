<?php

namespace App\Services\frontend;

use App\Exceptions\CustomGenericException;
use App\Model\Bill;
use App\Model\BillOrder;
use App\Model\Customer;
use App\Model\Income;
use App\Model\Order;
use App\Model\Transaction;
use App\Services\frontend\IncomeService;
use App\Services\frontend\TransactionService;
use App\Services\Service;
use App\Services\System\BillOrderService;
use App\Services\System\CustomerService;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

class BillService extends Service
{

    public $orderService, $frontendUser, $customerService,$transactionService;
    public function __construct(Bill $bill)
    {
        parent::__construct($bill);
        $this->orderService = new OrderService(new Order);
        $this->customerService = new CustomerService(new Customer);
        $this->transactionService = new TransactionService(new Transaction);
        $this->billOrderService = new BillOrderService(new BillOrder);
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
        $orderType = $request->bill[0]['order_id'];
        DB::beginTransaction();
        try {
            //Urgent Order value is 4
            $data = $request->all();
            $data['qr_code'] = uniqid();
            if ($orderType == 4) {
                $data['cleared_date'] =  $request->ordered_date;
                $data['cleared_by'] =  $request->user_id;
                $data['status'] = true;
            }
            $customerId = uniqid();
            if (empty($request->oldCustomer)) {
                $name = $this->changeNameFormat($request->name);
                $customer = $this->customerService->store($request->merge(['name'=>$name,'customer_id' => $customerId]));
                $data['customer_id'] = $customer->id;
            } else {
                $data['customer_id'] = $request->oldCustomer;
            }
            $bill = $this->model->create($data);

            //For recording transactions
            $transaction = $request->except('_token');
            $transaction['date'] =  $request->ordered_date;
            $transaction['amount'] =  $request->paid_amount;
            $transaction['bill_id'] = $bill->id;
            $this->transactionService->store($transaction);

            //Storing multiple orders
            $this->billOrderService->store($request->merge(['bill_id' => $bill->id]));
            DB::commit();
            return $bill;
        } catch (\Exception $e) {
            DB::rollback();
            throw new CustomGenericException($e->getMessage());
        }
    }

    public function changeNameFormat($name){
        $nameArray = explode(' ', $name);
        if(count($nameArray) == 2){
           return ucfirst($nameArray[0]).' '. ucfirst($nameArray[1]);
        }else{
            return ucfirst($nameArray[0]).' '. ucfirst($nameArray[1]).' '.ucfirst($nameArray[2]);
        }
    }

    public function update($request, $id)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $item = $this->itemByIdentifier($id);
            $data['status'] = true;
            $data['cleared_by'] = $request->user_id;
            $data['cleared_date'] = $request->cleared_date;
            $data['cash_received'] = $request->cash_received;
            $data['cash_return'] = $request->cash_return;
            $item = $this->itemByIdentifier($id);
            $item->update($data);

            $transaction['date'] =  $request->cleared_date;
            $transaction['amount'] =  $request->total;
            $transaction['bill_id'] = $request->bill_id;
            $transaction['bill_type'] = 1;

            $this->transactionService->store($transaction);

            DB::commit();
            return $item;
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            throw new CustomGenericException($e->getMessage());
        }
    }


    public function createPageData($request)
    {

        return [
            // 'orders' => $this->orderService->getAllData($request->merge(['pluck' => true])),
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
