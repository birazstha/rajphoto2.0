<?php

namespace App\Http\Controllers\System\bank;

use App\Http\Controllers\System\ResourceController;
use App\Services\System\SavingService;

class BankController extends ResourceController
{
    
    public function __construct(SavingService $savingService)
    {
        parent::__construct($savingService);
    }

    // public function storeValidationRequest()
    // {   
    //     return 'App\Http\Requests\system\sizeRequest';
    // }

    // public function updateValidationRequest()
    // {
    //     return 'App\Http\Requests\system\sizeRequest';
    // }

    public function moduleName()
    {
        return 'banks';
    }

    public function viewFolder()
    {
        return 'system.saving';
    }

   

   
}
