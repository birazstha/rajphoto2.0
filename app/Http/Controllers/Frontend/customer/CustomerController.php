<?php

namespace App\Http\Controllers\Frontend\customer;

use App\Http\Controllers\Controller;
use App\Model\Bill;
use App\Model\Customer;
use App\Services\System\BillService;
use App\Services\frontend\CustomerService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected $customerService,$billService;
    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
        $this->moduleName = 'Customer Detail';
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

    public function update(Request $request, $id){
        // $user = $this->customerService->itemByIdentifier($id);

        try{
            $this->customerService->update($request,$id);
            return redirect()->back()->with('success', 'Customer Info Updated!!');
        }
        catch(\Exception $e){
            dd($e);
        }
        
    }


}
