@section('main-content')


    <style type="text/css">
        /*if you want to remove some content in print display then use .no_print class on it */
        @media print {
            #datatable_wrapper .row:first-child {display:none;}
            #datatable_wrapper .row:last-child {display:none;}
            .no_print {display:none;}
        }
    </style>
    <div id="bill-container">

    <div class="table" id="bill">
        <div class="table-responsive">

            <table class="table table-bordered">
                <div class="qrcode">
                    <h1>Raj Photo Studio</h1>
                {!! QrCode::size(100)->generate($data['row']->qr_code); !!}
                <!--                    --><?php
                    //                    $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                    //                    echo $generator->getBarcode($data['row']->id, $generator::TYPE_CODE_128)
                    //                    ?>

                </div>

          <tr>
              <td colspan="11">
                  <b>Name:</b> {{$data['row']->name}}
              </td>
              <td >
                 <b>Bill Type:</b> Photo
              </td>
          </tr>
                <tr>
                    <td colspan="11" >
                        <b>Ordered Date:</b> {{$data['row']->ordered_date}}
                    </td>
                    <td>
                        <b>Delivery Date:</b> {{$data['row']->delivery_date}}
                    </td>
                </tr>
               <table class="table table-bordered">

                   <tr>
                   <td><b>Particulars</b></td>
                       <td><b>Quantity</b></td>
                   <td><b>Rate</b></td>
                   <td><b>Total</b></td>
                   </tr>



                   <tr>
                       <td rowspan="1">{{$data['row']->order->name}}</td>
                       <td rowspan="1">{{$data['row']->quantity}}</td>
                       <td rowspan="1">रु{{$data['row']->rate}}</td>
                       <td rowspan="1">रु{{$data['row']->total}}</td>

                   </tr>

                   <tr>
                       <td colspan="3"><b>Net Total</b></td>
                       <td>रु{{$data['row']->total}}</td>
                   </tr>
                   <tr>
                       <td colspan="3"><b>Advance</b></td>
                       <td>रु{{$data['row']->paid_amount}}</td>
                   </tr>
                   <tr>
                       <td colspan="3"><b>Balance</b></td>
                       <td>रु{{$data['row']->balance_amount}}</td>
                   </tr>

                   <tr>
                       <td colspan="3"><b>Cash Received</b></td>
                       <td>रु{{$data['row']->cash_received}}</td>
                   </tr>
                   <tr>
                       <td colspan="3"><b>Cash Returned</b></td>
                       <td> रु{{$data['row']->cash_return}}</td>
                   </tr>
               </table>
            </table>

                <div class="prepare">Bill Prepared By: {{$data['row']->user->name}}</div>


        </div>

    </div>
        <a style="text-align: center;" class="btn btn-primary text-white no_print" id="printBtn" onclick="window.print()"><i class="nav-icon fas fa-print"></i>Print</a>

    </div>


@endsection

@section('js')
    @include($base_route.'include.script')
    @include($base_route.'include.print')

    <!--No print-->
    <script type="text/javascript" src="{{asset('backend/plugins/jQuery.print.min.js')}}"></script>
    <script type="text/javascript">
        $(function() {

            $("#printBtn").on('click', function() {

                $.print("#printable");

            });

        });
    </script>

@endsection

@include('frontend.layout.master')


