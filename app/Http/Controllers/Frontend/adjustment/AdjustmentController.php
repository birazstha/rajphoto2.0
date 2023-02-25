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

        $type =  $this->adjustmentService->store($request);

        return redirect()->back()->with(['success' => $type === 'closing' ? 'Closing Balance recorded Successfully ' : 'Opening Balance recorded successfully']);
    }
}
