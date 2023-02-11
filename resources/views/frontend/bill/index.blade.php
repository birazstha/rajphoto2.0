@extends('frontend.layout.master')
@section('main-content')
    {{ Session::has('success') }}
    <div class="d-flex justify-content-between mb-2 align-items-center">
        <h2>Bills</h2>
        <a class="btn btn-success" href="{{ route('bills.create') }}"><i class="fa fa-plus"></i>&nbspCreate</a>


    </div>

    <div class="mb-4">
        <form class="d-flex">
            @csrf
            <div class="input-group input-group">
                <input type="text" class="form-control customerName" placeholder="Enter Customer's Name or Phone number">
                <span class="input-group-append">
                    <input type="text" value="" name="todays-date" class="form-control text-center"
                        id="todays-date">
                </span>
            </div>
        </form>
    </div>

    <div class="loader">
        <img src="{{ asset('public/images/loader.gif') }}" alt="">
    </div>

    <div id="table"></div>
@endsection
@section('js')
    <script src="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v3.7.min.js"
        type="text/javascript"></script>

    @include('frontend.bill.include.scripts.filter')
    {{-- @include('frontend.bill.include.scripts.pagination') --}}
    @include('frontend.bill.include.scripts.script')

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
