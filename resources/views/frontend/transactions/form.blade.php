@extends('frontend.layout.master')
@section('main-content')
    <div class="tab-slider--nav">
        <ul class="tab-slider--tabs">
            <li class="tab-slider--trigger active" rel="tab1">Income</li>
            <li class="tab-slider--trigger" rel="tab2">Expense</li>
        </ul>
    </div>
    <div class="tab-slider--container">
        <div id="tab1" class="tab-slider--body">
            <form action="{{ route('other-incomes.store') }}" method="POST" autocomplete="off" id="form">
                @csrf
                <!--Prepared by-->
                <div class="form-group row">
                    {!! Form::label('order_id', 'Income', ['class' => 'col-sm-2 col-form-label']) !!}
                    <div class="col-sm-10">

                        <select name="order_id" id="other" class="form-control" required>
                            <option value="" selected>Select Income Title</option>
                            @foreach ($orders as $order)
                                <option value="{{ $order->id }}">{{ $order->name }}</option>
                            @endforeach
                        </select>

                        @error('order_id')
                            <span class="text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <!--Rate-->
                <div class="row">
                    <div class="col-4">
                        <div class="form-group row">
                            {!! Form::label('grand_total', 'Rate', ['class' => 'col-sm-6 col-form-label']) !!}
                            <div class="col-sm-6">
                                <td><input type="number" name="rate" value="" id="other_rate"
                                        class="form-control">
                                </td>
                            </div>
                        </div>
                    </div>

                    <!--Quantity-->
                    <div class="col-4">
                        <div class="form-group row">
                            {!! Form::label('paid_amount', 'Quantity', ['class' => 'col-sm-3 col-form-label']) !!}
                            <div class="col-sm-6">
                                <td><input type="number" name="quantity" value="1" id="other_quantity"
                                        class="form-control" {{ isset($item) ? 'readonly' : '' }} required>
                                </td>
                            </div>
                        </div>
                        @error('paid_amount')
                            <p class="text text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-4">
                        <!--Total-->
                        <div class="form-group row">
                            {!! Form::label('total', 'Total', ['class' => 'col-sm-4 col-form-label']) !!}
                            <div class="col-sm-6">
                                <td><input type="text" name="total" id="other_total"
                                        value="{{ $item->due_amount ?? '' }}" readonly class="form-control"></td>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <!--Cash Received-->
                        <div class="form-group row">
                            <label for="order_date" class="col-sm-4 col-form-label">Cash Received</label>
                            <div class="col-sm-8">
                                <input type="number" name="cash_received" value="{{ $item->cash_received ?? '' }}"
                                    id="other_cash_received" class="form-control" required>
                            </div>
                        </div>

                    </div>
                    <div class="col-6">
                        <!--Cash Return-->
                        <div class="form-group row">
                            <label for="texr" class="col-sm-4 col-form-label">Cash Return</label>
                            <div class="col-sm-8">
                                <input type="text" name="cash_return" value="{{ $item->cash_return ?? '' }}"
                                    id="other_cash_return" class="form-control" readonly>
                            </div>
                        </div>
                        @error('delivery_date')
                            <span class="text text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <input type="hidden" name="date" class="order-date" value="">
                </div>

                <button class="btn btn-success btn-sm"><i class="fas fa-save"></i> Save</button>
                <button type="reset" class="btn btn-secondary btn-sm"><i class="fas fa-recycle"></i> Reset</button>
            </form>


        </div>
        <div id="tab2" class="tab-slider--body">
            <h2>Tab 2</h2>
            <p>Tab 2 content</p>
        </div>

    </div>
@endsection

@section('js')
    <script src="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v3.7.min.js"
        type="text/javascript"></script>
    <script>
        $("document").ready(function() {
            $(".tab-slider--body").hide();
            $(".tab-slider--body:first").show();
        });

        $(".tab-slider--nav li").click(function() {
            $(".tab-slider--body").hide();
            var activeTab = $(this).attr("rel");
            $("#" + activeTab).fadeIn();
            if ($(this).attr("rel") == "tab2") {
                $('.tab-slider--tabs').addClass('slide');
            } else {
                $('.tab-slider--tabs').removeClass('slide');
            }
            $(".tab-slider--nav li").removeClass("active");
            $(this).addClass("active");
        });


        var currentBsDate = NepaliFunctions.ConvertDateFormat(NepaliFunctions.GetCurrentBsDate(), 'YYYY-MM-DD');
        $('.order-date').val(currentBsDate);






        //For Other Incomes

        const calculatetotal = function(data) {
            var quantity = $("#other_quantity").val();
            var total = quantity * data;
            $("#other_total").val(total)

        };

        $("#other").change(function() {
            var incomeTitle = $(this).val();
            $.ajax({
                method: 'get',
                url: "{{ URL::route('bill.getRate') }}",
                data: {
                    'order_id': incomeTitle,
                    '_token': "{{ csrf_token() }}"
                },
                dataType: 'text',
                success: function(response) {
                    $("#other_rate").val(response);
                    calculatetotal(response);
                },
            });
        });

        $("#other_rate").on('keyup change', function() {
            var rate = $(this).val()
            calculatetotal(rate);
        });

        $("#other_quantity").on('keyup change', function() {
            var quantity = $(this).val()
            var currRate = $("#other_rate").val();
            var totaldd = quantity * currRate;
            $("#other_total").val(totaldd);

        });

        $("#other_cash_received").on('keyup', function() {
            var cashReceived = $(this).val();
            var total = $("#other_total").val();
            var cashReturn = cashReceived - total;
            $("#other_cash_return").val(cashReturn);
        });
    </script>
@endsection
