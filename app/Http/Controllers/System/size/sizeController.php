<?php

namespace App\Http\Controllers\System\size;

use App\Http\Controllers\System\ResourceController;
use App\Model\Order;
use App\Services\System\OrderService;
use App\Services\System\SizeService;
use Illuminate\Http\Request;

class sizeController extends ResourceController
{
    
    public function __construct(SizeService $categoryService)
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
        return 'sizes';
    }

    public function viewFolder()
    {
        return 'system.size';
    }

   

   
}
