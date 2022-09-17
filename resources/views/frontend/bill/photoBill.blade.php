@section('main-content')
    <style type="text/css">
        /*if you want to remove some content in print display then use .no_print class on it */
        @media print {
            #datatable_wrapper .row:first-child {
                display: none;
            }

            #datatable_wrapper .row:last-child {
                display: none;
            }

            .no_print {
                display: none;
            }
        }
    </style>
    <div id="bill-container">

        <div class="table" id="bill">
            <div class="table-responsive">

                <table class="table table-bordered">
                    <div class="qrcode">
                        <h1>Raj Photo Studio</h1>
                        {!! QrCode::size(100)->generate($data['row']->qr_code) !!}
                    </div>
                    <tr>
                        <td colspan="11">
                            <b>Name:</b> {{ $data['row']->customers->name }}
                        </td>
                        <td>
                            <b>Phone No:</b> {{ $data['row']->customers->phone_number }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="11">
                            <b>Ordered Date:</b> {{ $data['row']->ordered_date }}
                        </td>
                        <td>
                            <b>Delivery Date:</b> {{ $data['row']->delivery_date }}
                        </td>
                    </tr>
                </table>


                <table class="table table-bordered">
                    <tr>
                        <th>#</th>
                        <th>Particular</th>
                        <th>Size</th>
                        <th>Rate</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>

                    <tr>
                        <td>1</td>
                        <td>{{ $data['row']->billOrders[0]->orders->name }}</td>
                        <td>{{ $data['row']->billOrders[0]->sizes->name }}</td>
                        <td>{{ $data['row']->billOrders[0]->rate }}</td>
                        <td>{{ $data['row']->billOrders[0]->quantity }}</td>
                        <td>रु{{ $data['row']->billOrders[0]->total }}</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        @if (isset($data['row']->billOrders[1]))
                            <td>{{ $data['row']->billOrders[1]->orders->name }}</td>
                            <td>{{ $data['row']->billOrders[1]->sizes->name }}</td>
                            <td>{{ $data['row']->billOrders[1]->rate }}</td>
                            <td>{{ $data['row']->billOrders[1]->quantity }}</td>
                            <td>रु{{ $data['row']->billOrders[1]->total }}</td>
                        @else
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>-</td>
                        @endif
                    </tr>

                    <tr>
                        <td>3</td>
                        @if (isset($data['row']->billOrders[2]))
                            <td>{{ $data['row']->billOrders[2]->orders->name }}</td>
                            <td>{{ $data['row']->billOrders[2]->sizes->name }}</td>
                            <td>{{ $data['row']->billOrders[2]->rate }}</td>
                            <td>{{ $data['row']->billOrders[2]->quantity }}</td>
                            <td>रु{{ $data['row']->billOrders[2]->total }}</td>
                        @else
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>-</td>
                        @endif
                    </tr>

                    <tr>
                        <td>4</td>
                        @if (isset($data['row']->billOrders[3]))
                            <td>{{ $data['row']->billOrders[3]->orders->name }}</td>
                            <td>{{ $data['row']->billOrders[3]->sizes->name }}</td>
                            <td>{{ $data['row']->billOrders[3]->rate }}</td>
                            <td>{{ $data['row']->billOrders[3]->quantity }}</td>
                            <td>रु{{ $data['row']->billOrders[3]->total }}</td>
                        @else
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>-</td>
                        @endif
                    </tr>

        
                    <tr>
                        <th colspan="5">Grand Total</th>
                        <td>रु{{ $data['row']->grand_total }}</td>
                    </tr>



                    <tr>
                        <th colspan="5">Amount Paid</th>
                        <td>रु{{ $data['row']->paid_amount }}</td>
                    </tr>
                    <tr>
                        <th colspan="5">Balance Amount</th>
                        <td>रु{{ $data['row']->due_amount }}</td>
                    </tr>
                    <tr>
                        <th colspan="5">Cash Received</th>
                        <td>रु{{ $data['row']->cash_received }}</td>
                    </tr>
                    <tr>
                        <th colspan="5">Cash Returned</th>
                        <td>रु{{ $data['row']->cash_return }}</td>
                    </tr>
                </table>
                <div class="prepare">Bill Prepared By: {{ $data['row']->users->name }}</div>


            </div>

        </div>
        <a style="text-align: center;" class="btn btn-primary text-white no_print" id="printBtn"
            onclick="window.print()"><i class="nav-icon fas fa-print"></i>Print</a>

    </div>
@endsection

@section('js')
    {{-- @include($base_route.'include.script')
    @include($base_route.'include.print') --}}

    <!--No print-->
    <script type="text/javascript" src="{{ asset('backend/plugins/jQuery.print.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {

            $("#printBtn").on('click', function() {

                $.print("#printable");

            });

        });
    </script>
@endsection

@include('frontend.layout.master')
