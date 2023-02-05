@extends('frontend.layout.master')
@section('main-content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create Bill</h3>
        </div>

        <form class="form-horizontal" action="{{ route('bills.store') }}" method="POST" autocomplete="off">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-6">
                        <!--Name-->
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label">Name</label>
                            <div class="col-sm-8">
                                <input type="text" value="" name="name"
                                    class="typeahead form-control search-name" id="customer_name"
                                    placeholder="Enter customer's name" required>
                            </div>
                        </div>

                    </div>

                    <div class="col-6">
                        <!--Phone-->
                        <div class="form-group row">
                            <label for="phone_number" class="col-sm-4 col-form-label">Phone</label>
                            <div class="col-sm-8">
                                <input type="number" value="" name="phone_number" class="form-control search-phone"
                                    id="phone_number" placeholder="Enter customer's phone number." required>
                                <span class="text text-danger" id="error-phone"></span>
                            </div>

                        </div>

                    </div>


                </div>

                {{-- For delivery --}}
                <div class="dynamic-input">
                    <div class="row" id="order-1">
                        <!--Order-->

                        {!! Form::label('order_id', 'Order', ['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-2">
                            <select name="bill[0][order_id]" id="1" data-id="order" class="form-control" required>
                                <option value="" selected>Select Order Type</option>
                                @foreach ($orders as $order)
                                    <option value="{{ $order->id }}">{{ $order->name }}</option>
                                @endforeach
                            </select>
                        </div>



                        <!--Size-->
                        <div class="col-2 form-group row">
                            {!! Form::label('size_id', 'Size', ['class' => 'col-sm-3 col-form-label']) !!}
                            <div class="col-sm-9">
                                <select name="bill[0][size_id]" id="size_id_1" data-id="1" data-class="size"
                                    class="form-control" required>
                                    <option value="" selected>Select a size</option>
                                </select>
                            </div>
                        </div>


                        <!--Rate-->
                        <div class="col-2 form-group row">
                            {!! Form::label('rate', 'Rate', ['class' => 'col-sm-3 col-form-label']) !!}
                            <div class="col-sm-9">
                                <input type="number" name="bill[0][rate]" id="rate1" data-id="1" data-type="rate"
                                    class="form-control" required>
                                @error('rate')
                                    <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!--Quantity-->
                        <div class="col-2 form-group row">
                            {!! Form::label('quantity', 'Qty', ['class' => 'col-sm-4 col-form-label']) !!}
                            <div class="col-sm-8">
                                <input type="number" min="1" name="bill[0][quantity]" id="quantity1" data-id="1"
                                    data-type="quantity" value="1" class="form-control">
                                @error('quantity')
                                    <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>



                        <!--Total-->
                        <div class="col-2 form-group row">
                            {!! Form::label('total', 'Total', ['class' => 'col-sm-3 col-form-label']) !!}
                            <div class="col-sm-9">
                                <input type="text" name="bill[0][total]" id="total1" value="" readonly
                                    class="form-control"> @error('rate')
                                    <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="remove-order">
                            <i class="fas fa-times removeOrder d-none" data-orderId="order-1" data-order='1'></i>
                        </div>
                    </div>
                </div>
                <div class="{{ isset($item) ? 'd-none' : '' }}">
                    <button type="button" class="btn btn-info btn-sm" id="btnAdd"><i
                            class="fas fa-plus"></i>&nbspAdd</button>
                </div>

                <div class="toggle-other-title d-none">
                    <!--Delivery Date-->
                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" name="other_income_title" class="form-control">
                        </div>
                    </div>
                    @error('delivery_date')
                        <span class="text text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!--Grand Total-->
                <div class="row">
                    <div class="col-4">
                        <div class="form-group row">
                            {!! Form::label('grand_total', 'Grand Total', ['class' => 'col-sm-6 col-form-label']) !!}
                            <div class="col-sm-6">
                                <td><input type="number" name="grand_total" value="{{ $item->grand_total ?? '0' }}"
                                        id="grand_total" class="form-control" readonly>
                                </td>
                            </div>
                        </div>
                    </div>

                    <!--Paid Amount-->
                    <div class="col-4">
                        <div class="form-group row">
                            {!! Form::label('paid_amount', 'Paid Amount', ['class' => 'col-sm-3 col-form-label']) !!}
                            <div class="col-sm-6">
                                <td><input type="number" name="paid_amount" value="{{ $item->paid_amount ?? '' }}"
                                        id="paid_amount" class="form-control" required>
                                </td>
                                <span class="text text-danger" id="error-paid-amount"></span>
                            </div>
                        </div>
                        @error('paid_amount')
                            <p class="text text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-4">
                        <!--Balance Amount-->
                        <div class="form-group row">
                            {!! Form::label('total', 'Due Amount', ['class' => 'col-sm-4 col-form-label']) !!}
                            <div class="col-sm-6">
                                <td><input type="text" name="due_amount" id="due_amount"
                                        value="{{ $item->due_amount ?? '' }}" readonly class="form-control"></td>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Payment Method-->
                <div class="form-group row d-none" id="toggle-payment-method">
                    {!! Form::label('', 'Payment Method', ['class' => 'col-sm-2 col-form-label']) !!}
                    <div class="col-sm-10">

                        <select name="" class="form-control" id="payment_method" required>
                            <option value="cash" selected>Cash</option>
                            <option value="online">Online</option>
                        </select>
                    </div>
                </div>

                {{-- Payment Gateway --}}
                <div class="form-group row d-none" id="toggle-payment">
                    {!! Form::label('payment_gateway', 'Payment Gateway', ['class' => 'col-sm-2 col-form-label']) !!}
                    <div class="col-sm-10" style="display: flex; flex-direction:row; align-item:center">
                        @foreach ($payments as $payment)
                            <div class="form-check" style="display: flex; align-items:center;">
                                <input class="form-check-input" name="payment_gateway" type="radio"
                                    id="flexRadioDefault1" value="{{ $payment->id }}">
                                <label class="form-check-label mr-2" for="flexRadioDefault1">
                                    <img src="{{ asset('public/uploads/payment-method/' . $payment->image) }}"
                                        height="50px" alt="">
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <input type="hidden" value="" name="ordered_date" class="form-control order-date"
                    id="order-date" readonly="readonly">


                <div class="row">

                    <div class="">
                        <!--Delivery Date-->
                        <div class="form-group row">
                            <label for="texr" class="col-sm-2 col-form-label">Delivery Date</label>
                            <div class="col-sm-10">
                                <input type="text" name="delivery_date" required
                                    value="{{ $item->delivery_date ?? '' }}" class="form-control" id="delivery-date">
                            </div>
                        </div>
                        @error('delivery_date')
                            <span class="text text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <!--Prepared by-->
                    <div class="form-group row">
                        {!! Form::label('user_id', 'Prepared By', ['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                            @if (isset($item))
                                <select name="user_id" class="form-control" required>
                                    @foreach ($users as $user)
                                        <option {{ $item->user_id == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            @else
                                <select name="user_id" class="form-control" required>
                                    <option value="" selected>Select your name</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            @endif

                            @error('user_id')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>
                <button class="btn btn-success btn-sm"><i class="fas fa-save"></i> Save</button>
                <button type="reset" class="btn btn-secondary btn-sm"><i class="fas fa-recycle"></i>
                    Reset</button>



            </div>
        </form>

    </div>
@endsection

@section('js')
    <script src="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v3.7.min.js"
        type="text/javascript"></script>

    @include('frontend.bill.include.scripts.filter')
    {{-- @include('frontend.bill.include.scripts.pagination') --}}
    @include('frontend.bill.include.scripts.script')


    <script>
        $(document).ready(function() {
            $('#customer_name').focus();
        });
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


        $('#order-date').nepaliDatePicker({
            language: "english",
        });
        var currentBsDate = NepaliFunctions.ConvertDateFormat(NepaliFunctions.GetCurrentBsDate(), 'YYYY-MM-DD');
        $('.order-date').val(currentBsDate);

        //Delivery date
        $('#delivery-date').nepaliDatePicker({
            language: "english",
        });
        var deliveryDate = NepaliFunctions.ConvertDateFormat(NepaliFunctions.BsAddDays(NepaliFunctions
            .GetCurrentBsDate(), 1), 'YYYY-MM-DD')
        $('#delivery-date').val(deliveryDate);
    </script>

    <script>
        $(document).on('change', '#payment_method', function() {
            var method = $(this).val();
            if (method == 'online') {
                $('#toggle-payment').removeClass('d-none');
                $('#cash-transaction').addClass('d-none');
            } else {
                $('#toggle-payment').addClass('d-none');
                $('#cash-transaction').removeClass('d-none');
            }
        });


        $(document).ready(function() {
            $('#createBill').on('shown.bs.modal', function() {
                $('#customer_name').focus();
            })

            //Search Customer by name
            $(".search-name").autocomplete({
                classes: {
                    "ui-autocomplete": "highlight"
                },
                source: function(request, response) {
                    $.ajax({
                        url: "{{ route('autoCompleteSearch') }}",
                        type: 'GET',
                        dataType: "json",
                        data: {
                            search: request.term
                        },
                        success: function(data) {
                            console.log(data);

                            response(data.slice(0, 10));
                        }
                    });
                },
                delay: 100,
                select: function(event, ui) {
                    $('.search-name').val(ui.item.label);
                    $('#phone_number').val(ui.item.phone_number);
                    return false;
                }
            });

            //Search Customer by phone
            $(".search-phone").autocomplete({
                classes: {
                    "ui-autocomplete": "highlight"
                },
                source: function(request, response) {
                    $.ajax({
                        url: "{{ route('autoCompletePhone') }}",
                        type: 'GET',
                        dataType: "json",
                        data: {
                            search: request.term
                        },
                        success: function(data) {
                            response(data.slice(0, 10));
                        }
                    });
                },
                select: function(event, ui) {
                    $('.search-phone').val(ui.item.label);
                    return false;
                }
            });


        });
    </script>
@endsection
