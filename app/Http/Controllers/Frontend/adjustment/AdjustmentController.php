<?php

namespace App\Http\Controllers\frontend\adjustment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\frontend\AdjustmentService;

class AdjustmentController extends Controller
{

    protected $adjustmentService;
    public function __construct(AdjustmentService $adjustmentService)
    {
        $this->adjustmentService = $adjustmentService;
    }

    public function store(Request $request)
    {
        $this->adjustmentService->store($request);
    }
}
