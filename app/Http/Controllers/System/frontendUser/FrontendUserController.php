<?php

namespace App\Http\Controllers\System\frontendUser;

use App\Http\Controllers\System\ResourceController;
use App\Services\System\FrontendUserService;


class FrontendUserController extends ResourceController
{
    public function __construct(FrontendUserService $frontendUserService)
    {
        parent::__construct($frontendUserService);
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
        return 'frontend-users';
    }

    public function viewFolder()
    {
        return 'system.frontendUser';
    }

}
