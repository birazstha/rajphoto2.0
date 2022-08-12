<?php

namespace App\Http\Controllers\System\size;

use App\Http\Controllers\System\ResourceController;
<<<<<<< HEAD
use App\Services\System\SizeService;

class sizeController extends ResourceController
{
    public function __construct(SizeService $categoryService)
    {
        parent::__construct($categoryService);
=======
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
>>>>>>> 056d438f8dd74b2d5f5eec06b60f96ecd6fba377
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
<<<<<<< HEAD
        return 'size';
=======
        return 'sizes';
>>>>>>> 056d438f8dd74b2d5f5eec06b60f96ecd6fba377
    }

    public function viewFolder()
    {
        return 'system.size';
    }
<<<<<<< HEAD
=======

   

   
>>>>>>> 056d438f8dd74b2d5f5eec06b60f96ecd6fba377
}
