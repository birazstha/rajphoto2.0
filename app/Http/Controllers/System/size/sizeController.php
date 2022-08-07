<?php

namespace App\Http\Controllers\System\size;

use App\Http\Controllers\System\ResourceController;
use App\Services\System\SizeService;

class sizeController extends ResourceController
{
    public function __construct(SizeService $categoryService)
    {
        parent::__construct($categoryService);
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
        return 'size';
    }

    public function viewFolder()
    {
        return 'system.size';
    }
}
