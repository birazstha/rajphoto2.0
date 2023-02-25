<?php

namespace App\Services\frontend;

use App\Model\Bill;
use App\Model\Order;
use App\Model\Income;
use App\Model\Customer;
use App\Model\BillOrder;
use App\Model\Adjustment;
use App\Services\Service;
use App\Model\Transaction;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isNull;
use App\Services\frontend\IncomeService;
use App\Services\System\CustomerService;
use App\Services\System\BillOrderService;
use App\Exceptions\CustomGenericException;
use App\Model\Analytic;
use App\Services\frontend\AdjustmentService;
use App\Services\frontend\TransactionService;

class BillService extends Service
{

    public $orderService, $billOrderService,
        $frontendUser, $customerService, $transactionService, $adjustmentService, $analyticService;
    public function __construct(Bill $bill)
    {
        parent::__construct($bill);
        $this->orderService = new OrderService(new Order);
        $this->customerService = new CustomerService(new Customer);
        $this->transactionService = new TransactionService(new Transaction);
        $this->billOrderService = new BillOrderService(new BillOrder);
        $this->adjustmentService = new AdjustmentService(new Adjustment);
        $this->analyticService = new AnalyticService(new Analytic());
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
        DB::beginTransaction();
        try {
            //Urgent Order value is 4
            $data = $request->all();
            $data['qr_code'] = uniqid();
            $customerId = uniqid();
            if (empty($request->oldCustomer)) {
                $name = $this->changeNameFormat($request->name);
                $customer = $this->customerService->store($request->merge(['name' => $name, 'customer_id' => $customerId]));
                $data['customer_id'] = $customer->id;
            } else {
                $data['customer_id'] = $request->oldCustomer;
            }
            $data['photo_number'] = 'RAJ_' . $request->photo_number;
            $bill = $this->model->create($data);

            //For recording transactions
            $transaction = $request->except('_token');
            $transaction['date'] =  $request->ordered_date;
            $transaction['amount'] =  $request->paid_amount;
            $transaction['bill_id'] = $bill->id;
            $this->transactionService->store($transaction);

            //Check if closing balance is already adjusted or not
            $this->adjustmentService->updateAdjustment($request);
            //Storing multiple orders
            $this->billOrderService->store($request->merge(['bill_id' => $bill->id]));
            $this->analyticService->store($request);
            DB::commit();
            return  $data['qr_code'];
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            throw new CustomGenericException($e->getMessage());
        }
    }

    public function changeNameFormat($name)
    {

        $nameArray = explode(' ', $name);
        if (count($nameArray) == 1) {
            return  ucfirst($nameArray[0]);
        } elseif (count($nameArray) == 2) {
            return ucfirst($nameArray[0]) . ' ' . ucfirst($nameArray[1]);
        }
        return ucfirst($nameArray[0]) . ' ' . ucfirst($nameArray[1]) . ' ' . ucfirst($nameArray[2]);
    }

    public function update($request, $id)
    {

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


            $transaction = $request->all();

            $transaction['date'] =  $request->cleared_date;
            $transaction['amount'] =  $request->total;
            $transaction['bill_type'] = 1;

            $this->transactionService->store($transaction);

            $this->adjustmentService->updateAdjustment($request);

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


    public function getBillByQr($id)
    {
        return $this->model->where('qr_code', $id)->first();
    }

    public function indexPageData($request)
    {
        return [
            'items' => $this->getAllData($request),
            'order_id' => $request->order_id,
        ];
    }
}
