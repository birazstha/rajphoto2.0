<?php

namespace App\Http\Controllers\System\adjustment;

use App\Http\Controllers\System\ResourceController;
use App\Services\System\AdjustmentService;

class AdjustmentController extends ResourceController
{
    
    public function __construct(AdjustmentService $adjustmentService)
    {
        parent::__construct($adjustmentService);
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
