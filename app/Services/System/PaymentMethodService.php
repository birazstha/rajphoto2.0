<?php

namespace App\Services\System;

use App\Model\Adjustment;
use App\Model\Order;
use App\Model\PaymentMethod;
use App\Services\Service;

class PaymentMethodService extends Service
{
    public function __construct(PaymentMethod $paymentMethod)
    {
        parent::__construct($paymentMethod);
    }      
}


