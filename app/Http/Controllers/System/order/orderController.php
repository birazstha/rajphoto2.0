<?php

namespace App\Http\Controllers\System\order;

use App\Http\Controllers\System\ResourceController;
use App\Services\System\OrderService;

class orderController extends ResourceController
{
    public function __construct(OrderService $categoryService)
    {
        parent::__construct($categoryService);
    }

    public function storeValidationRequest()
    {   
        return 'App\Http\Requests\system\orderRequest';
    }

    public function updateValidationRequest()
    {
        return 'App\Http\Requests\system\orderRequest';
    }

    public function moduleName()
    {
        return 'order';
    }

    public function viewFolder()
    {
        return 'system.order';
    }
}
