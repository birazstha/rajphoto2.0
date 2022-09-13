<?php

namespace App\Http\Controllers\System;

use App\Model\Bill;
use Carbon\Carbon;
use Illuminate\Http\Request;

class indexController extends ResourceController
{
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $id = '')
    {

        $data = [
            'breadcrumbs' => $this->breadcrumbForIndex(),
            'income' => Bill::whereDate('created_at',Carbon::today())->sum('paid_amount'),
            'bills'=>Bill::all(),
        ];
        return $this->renderView('index', $data);
    }

    public function moduleName()
    {
        return 'home';
    }

    /**
     * @returns {string}
     */
    public function viewFolder()
    {
        return 'system.home';
    }
}
