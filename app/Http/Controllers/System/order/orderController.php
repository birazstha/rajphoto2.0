<?php

namespace App\Http\Controllers\System\order;

use App\Http\Controllers\System\ResourceController;
use App\Model\Order;
use App\Services\System\OrderService;
use Illuminate\Http\Request;

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

    public function getSizeByOrderId(Request $request)
    {
        $order=Order::find($request->input('order_id'));
   
        $html="<option value=''>Select a size</option>";
        foreach ($order->sizes as $size)
        {

            $html.="<option value='$size->id'>$size->title</option>";
        }
        return $html;

    }
}
