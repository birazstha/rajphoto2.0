<?php

namespace App\Http\Controllers\System;

use App\Model\Bill;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $mytime = Carbon::now()->toDateTimeString();
        // dd($mytime);

        $data = [
            'breadcrumbs' => $this->breadcrumbForIndex(),
            'income' => Bill::where('created_at',$mytime)->sum('paid_amount'),
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
