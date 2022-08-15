<?php

namespace App\Http\Controllers\System\rate;

use App\Http\Controllers\System\ResourceController;
use App\Model\Order;
use App\Services\System\OrderService;
use App\Services\System\RateService;


class RateController extends ResourceController
{
    
    public function __construct(RateService $categoryService)
    {
        parent::__construct($categoryService);
        $this->orderService = new OrderService(new Order);
    }

    public function storeValidationRequest()
    {   
        return 'App\Http\Requests\system\sizeRequest';
    }

    public function updateValidationRequest()
    {
        return 'App\Http\Requests\system\sizeRequest';
    }

    public function moduleName()
    {
        return 'rates';
    }

    public function viewFolder()
    {
        return 'system.rate';
    }

   

   
}
