@extends('frontend.layout.master')
@section('main-content')
    {{ Session::has('success') }}
    <div class="d-flex justify-content-between mb-2 align-items-center">
        <h2>Customer Detail</h2>
        <hr>
        <div>
            <button data-toggle="modal" data-target="#edit-customer" target="_blank"
                class="btn btn-primary open-AddBookDialog"><i class="fa fa-pen"></i>&nbspEdit</button>


            @include('frontend.customer.edit')
        </div>
    </div>

    <div>
        <table class="table table-bordered">
            <tr>
                <td class="font-weight-bold w-25">Name:</td>
                <td>{{ $customers->name }}</td>
            </tr>
            <tr>
                <td class="font-weight-bold">Phone Number:</td>
                <td>{{ $customers->phone_number }}</td>
            </tr>
            <tr>
                <td class="font-weight-bold">Customer ID:</td>
                <td>{{ $customers->customer_id }}</td>
            </tr>
            <tr>
                <td class="font-weight-bold">Joined Since:</td>
                <td>{{ $customers->created_at }}</td>
            </tr>
            <tr>
                <td class="font-weight-bold">No. of Orders:</td>
                <td>{{ count($customers->bills) }}</td>
            </tr>
        </table>

    </div>

    {{-- Bills --}}
    <div class="d-flex justify-content-between mb-2 align-items-center">
        <h2>Bills</h2>
        <hr>
    </div>

    <table class="room-table">
        <thead>
            <tr>
                <th class="text-center">S.No</th>
                <th class="text-center">Order's Detail</th>
                <th class="text-center">Amount Details</th>
                <th class="text-center">Date</th>
                <th class="text-center">Status</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>

        <tbody>

            @forelse ($bills as $key => $bill)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    {{-- <td>{{ $bill->id }}</td> --}}

                    <td class="change">
                        @foreach ($bill->billOrders as $key => $billOrder)
                            <div class="order-detail">
                                {{ $key + 1 }}. {{ $billOrder->orders->name }} - {{ $billOrder->sizes->name }}
                                - {{ $billOrder->quantity }} pc
                            </div>
                        @endforeach

                    </td>

                    <td>
                        <div class="test3">
                            <div class="amounts">
                                <div>
                                    <div class="font-weight-bold">Total:</div>
                                    <div class="font-weight-bold">Advance:</div>
                                    <div class="font-weight-bold">Due:</div>
                                </div>
                                <div>
                                    <div>Rs. {{ $bill->grand_total }}</div>
                                    <div>
                                        @if ($bill->paid_amount === 0)
                                            <span class="badge badge-danger badge-sm">Unpaid</span>
                                        @else
                                            Rs. {{ $bill->paid_amount }}
                                        @endif
                                    </div>
                                    <div>
                                        @if ($bill->due_amount === 0)
                                            <span class="badge badge-success ">Paid</span>
                                        @else
                                            Rs. {{ $bill->due_amount }}
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    </td>

                    <td class="text-center">

                        <div class="customer-detail">
                            <div class="test1">
                                <div>
                                    <b>Ordered Date:</b> {{ $bill->ordered_date }}
                                </div>
                                <div>
                                    <b>Delivery Date:</b> {{ $bill->delivery_date }}
                                </div>
                            </div>
                        </div>
                    </td>


                    <td class="text-center">
                        @if ($bill->status)
                            <span class="badge badge-success btn-sm">Cleared</span>
                        @else
                            <span class="badge badge-info btn-sm">Pending</span>
                        @endif
                    </td>
                    <td>
                        <button data-toggle="modal" data-target="#billDetail{{ $bill->id }}" target="_blank"
                            data-bill={{ $bill->due_amount }} class="btn btn-success btn-sm open-AddBookDialog"><i
                                class="far fa-eye"></i></button>
                        @include('frontend.bill.include.clearBill')
                    </td>

                </tr>
            @empty
                <td colspan="9" class="text text-danger text-center">No data found</td>
            @endforelse

        </tbody>

    </table>


@endsection
@section('js')
    <script src="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v3.7.min.js"
        type="text/javascript"></script>
    <script>
        var currentBsDate = NepaliFunctions.ConvertDateFormat(NepaliFunctions.GetCurrentBsDate(), 'YYYY-MM-DD');
        $('.order-date').val(currentBsDate);
    </script>

    <script>
        var clearedDate = NepaliFunctions.ConvertDateFormat(NepaliFunctions.GetCurrentBsDate(), 'YYYY-MM-DD');
        $(document).on("click", ".open-AddBookDialog", function() {

            var dueAmount = $(this).data('bill');
            var totalAmount;
            $(".total").val(dueAmount);
            $('.cleared_date').val(clearedDate);

            //Calculating Total amount by deducting discount
            $(document).on('keyup', '#discount', function() {
                var discountAmount = $(this).val();
                totalAmount = dueAmount - parseInt(discountAmount);
                console.log(totalAmount);
                $(".total").val(totalAmount);
            });

            //Calculation Cash return
            $(document).on('keyup', '#cash_received', function() {
                var cashReceived = $(this).val();
                var totalAmt = $('.total').val();
                cashReturn = cashReceived - totalAmt;
                console.log(cashReturn);
                $(".cash_return").val(cashReturn);
            });
        });
    </script>
@endsection
