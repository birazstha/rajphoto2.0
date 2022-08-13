<?php

namespace App\Http\Controllers\Frontend\bill;

use App\Http\Controllers\Controller;
use App\Model\Bill;
use App\Model\BillOrder;
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
            'orders' => $this->orderService->getAllData($request),
        ];
        return view('frontend.bill.form', $data);
    }


    public function store(Request $request)
    {
        $data = $request->except(['_token', 'order_id', 'size_id', 'rate', 'quantity', 'total']);

        $data['row'] =  Bill::create($data);

        //Storing multiple orders detail
        if ($data['row']) {
            $billOrder['bill_id'] = $data['row']->id;
            $orders = $request->input('order_id');
            $sizes = $request->input('size_id');
            $quantities = $request->input('quantity');
            $rates = $request->input('rate');
            $totals = $request->input('total');

            for($i = 0; $i < count($orders); $i++){
                $billOrder['order_id'] = $orders[$i];
                $billOrder['size_id'] = $sizes[$i];
                $billOrder['quantity'] = $quantities[$i];
                $billOrder['rate'] = $rates[$i];
                $billOrder['total'] = $totals[$i];
                BillOrder::create($billOrder);
            }
        }
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
