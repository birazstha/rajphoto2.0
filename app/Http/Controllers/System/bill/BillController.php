<?php

namespace App\Http\Controllers\System\bill;

use App\Http\Controllers\System\ResourceController;
use App\Model\Order;
use App\Services\System\BillService;
use App\Services\System\OrderService;


class BillController extends ResourceController
{
    
    public function __construct(BillService $categoryService)
    {
        parent::__construct($categoryService);
        $this->orderService = new OrderService(new Order);
    }

    // public function storeValidationRequest()
    // {   
    //     return 'App\Http\Requests\system\sizeRequest';
    // }

    // public function updateValidationRequest()
    // {
    //     return 'App\Http\Requests\system\sizeRequest';
    // }


    public function indexUrl()
    {
        'rajphoto2.0'.'/'.PREFIX.'/'.$this->moduleName();
    }

    public function moduleName()
    {
        return 'bills';
    }

    public function viewFolder()
    {
        return 'system.bill';
    }

   

   
}
