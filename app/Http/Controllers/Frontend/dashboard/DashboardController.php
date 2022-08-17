<?php

namespace App\Http\Controllers\Frontend\dashboard;

use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Services\frontend\OrderService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->moduleName = 'Dashboard';
    }
    
   
    public function dashboard(Request $request){
        $data = [
            'pageTitle'=>$this->moduleName,
        ];
       return view('frontend.dashboard.index',$data);
    }
}
