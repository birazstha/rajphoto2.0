<?php

namespace App\Http\Controllers\Frontend\customer;

use App\Http\Controllers\Controller;
use App\Model\Bill;
use App\Model\Customer;
use App\Services\System\BillService;
use App\Services\System\CustomerService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    protected $customerService,$billService;
    public function __construct()
    {
        $this->moduleName = 'Customer Detail';
        $this->customerService = new CustomerService(new Customer);
        $this->billService = new BillService(new Bill);

    }


    public function search(Request $request, $id)
    {
        $data = [
            'pageTitle' => $this->moduleName,
            'customers' => $this->customerService->itemByIdentifier($id),
            'bills' => $this->billService->getBillByCustomer($id),
        ];
        return view('frontend.customer.index', $data);
    }
}
