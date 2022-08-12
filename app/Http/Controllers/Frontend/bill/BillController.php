<?php

namespace App\Http\Controllers\Frontend\bill;

use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Services\frontend\OrderService;
use Illuminate\Http\Request;

class BillController extends Controller
{
    protected $orderService;
    public function __construct()
    {
        $this->orderService = new OrderService(new Order);
        
    }
    
    public function index()
    {
        //
    }

    
    public function create(Request $request)
    {

        $data = [
            'orders'=>$this->orderService->getAllData($request),
        ];
        return view('frontend.bill.form',$data);
    }

   
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
