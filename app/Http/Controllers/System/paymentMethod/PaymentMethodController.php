<?php

namespace App\Http\Controllers\System\paymentMethod;

use App\Http\Controllers\System\ResourceController;
use App\Services\System\PaymentMethodService;

class PaymentMethodController extends ResourceController
{
    
    public function __construct(PaymentMethodService $paymentMethodService)
    {
        parent::__construct($paymentMethodService);
    }

    // public function storeValidationRequest()
    // {   
    //     return 'App\Http\Requests\system\sizeRequest';
    // }

    // public function updateValidationRequest()
    // {
    //     return 'App\Http\Requests\system\sizeRequest';
    // }
}
