<?php

namespace App\Http\Controllers\System\expense;

use App\Http\Controllers\System\ResourceController;
use App\Services\System\ExpenseService;

class ExpenseController extends ResourceController
{
    public function __construct(ExpenseService $expenseService)
    {
        parent::__construct($expenseService);
    }

    public function storeValidationRequest()
    {   
        return 'App\Http\Requests\system\expenseRequest';
    }

    public function updateValidationRequest()
    {
        return 'App\Http\Requests\system\expenseRequest';
    }

    public function moduleName()
    {
        return 'expenses';
    }

    public function viewFolder()
    {
        return 'system.expense';
    }

}
