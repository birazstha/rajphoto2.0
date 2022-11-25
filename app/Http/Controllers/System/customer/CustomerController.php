<?php

namespace App\Http\Controllers\System\customer;

use App\Http\Controllers\System\ResourceController;
use App\Model\Order;
use App\Services\System\CustomerService;
use App\Services\System\OrderService;


class CustomerController extends ResourceController
{
    
    public function __construct(CustomerService $customerService)
    {
        parent::__construct($customerService);
       
    }


    // public function updateValidationRequest()
    // {
    //     return 'App\Http\Requests\system\sizeRequest';
    // }


   

    public function moduleName()
    {
        return 'customers';
    }

    public function viewFolder()
    {
        return 'system.customer';
    }

   

   
}
