<?php

namespace App\Http\Controllers\Frontend\bill;

use App\Http\Controllers\System\ResourceController;
use App\Services\System\BillService;


class BillController extends ResourceController
{
    
    public function __construct(BillService $billService)
    {
        parent::__construct($billService);
    }

    public function storeValidationRequest()
    {   
        return 'App\Http\Requests\system\billRequest';
    }

    public function updateValidationRequest()
    {
        return 'App\Http\Requests\system\billRequest';
    }

    public function moduleName()
    {
        return 'bills';
    }

    public function viewFolder()
    {
        return 'frontend.bill';
    }

   

   
}
