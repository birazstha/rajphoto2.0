<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Bill;
use App\Model\Order;
use App\Model\Size;
use App\Traits\BillTrait;
use Illuminate\Http\Request;

class TestController extends Controller
{
    use BillTrait;
    
    public function getOrderById(Request $request)
    {

        $order = Order::find($request->input('order_id'));
        $html = "<option value=''>Select a size</option>";
        foreach ($order->sizes as $size) {
            $html .= "<option value='$size->id'>$size->name</option>";
        }
        return $html;
    }

    public function getRateBySize(Request $request)
    {
        $size = Size::find($request->input('size_id'));
        // dd($size);
        return $size->rate;
    }

    public function getCustomerInfo(Request $request)
    {

        if ($request->customer_name) {
            $customerDetail = Bill::where('name', 'ILIKE', '%' . $request->customer_name . '%')->paginate(20);
            return $this->filtered($customerDetail);
        } else {
            $customerDetail = Bill::where('ordered_date', 'ILIKE', '%' . $request->date . '%')->paginate(20);
            return $this->filtered($customerDetail);
        }
    }

    public function filtered($customerDetail)
    {
        $this->setBill($customerDetail);
        $output = "";
        foreach ($customerDetail as $key => $bill) {


            if($bill->balance_amount===0){
                $paid = '<span class="badge badge-success">Paid</span>';
            }else{
                $paid = $bill->balance_amount;
            }
           
      
            $output .=
                '<tr>
            <td> ' . $key + 1 . '</td>
              <td class="w-25"> ' . $bill->name . ' </td>     
              <td> ' . $bill->grand_total . ' </td>
              <td> ' . $bill->paid_amount . ' </td>
              <td> ' . $paid . ' </td>
              <td> ' . $bill->ordered_date . ' </td>
              <td> ' . $bill->delivery_date . ' </td>
              <td> ' . $bill->users->name . ' </td>
              <td>  
              <a href="search/' . $bill->qr_code . '" target="_blank" class="btn btn-success"><i class="far fa-eye"></i></a>
              <a href="" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
              <a href="bills/' . $bill->id . '" target="_blank" class="btn btn-warning"><i class="fas fas fa-print"></i></a>
              </td>
            </tr>';
        }
        return $output;
    }
}
