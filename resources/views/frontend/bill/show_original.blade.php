@section('main-content')

    <div class="table" id="bill">
        <div class="table-responsive">

            <table class="table table-bordered">

               <tr>
                   <th>I.D</th>
                   <td>{{$data['row']->id}}</td>
               </tr>
               <tr>
                   <th>Name</th>
                   <td>{{$data['row']->name}}</td>
               </tr>

               <tr>
                   <th>Order</th>
                   <td>{{$data['row']->order->name}}</td>
               </tr>

               <tr>
                   <th>Size</th>
                   <td>{{$data['row']->size->name}}</td>
               </tr>

               <tr>
                   <th>Quantity</th>
                   <td>{{$data['row']->quantity}}</td>
               </tr>

               <tr>
                   <th>Total Amount</th>
                   <td>{{$data['row']->net_total}}</td>
               </tr>

               <tr>
                   <th>Advance</th>
                   <td>{{$data['row']->paid_amount}}</td>
               </tr>

               <tr>
                   <th>Balance</th>
                   <td>{{$data['row']->balance_amount}}</td>
               </tr>

               <tr>
                   <th>Ordered Date</th>
                   <td>{{$data['row']->created_at}}</td>
               </tr>

               <tr>
                   <th>Delivery Date</th>
                   <td>{{$data['row']->delivery_date}}</td>
               </tr>



            </table>

        </div>

    </div>
    <button class="btn btn-primary" onclick="printBill()"><i class="fas fa-print"></i>Print</button>

@endsection

@section('js')
    @include($base_route.'include.script')
    @include($base_route.'include.print')

@endsection

@include('frontend.layout.master')


