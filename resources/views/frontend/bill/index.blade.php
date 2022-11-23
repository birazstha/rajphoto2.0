@extends('frontend.layout.master')
@section('main-content')
    {{ Session::has('success') }}


    <div class="d-flex justify-content-between mb-2 align-items-center">
        <h2>Bills</h2>
        <button data-toggle="modal" data-target="#createBill" target="_blank" class="btn btn-success open-AddBookDialog"><i
                class="fa fa-plus"></i>&nbspCreate</button>



        @include('frontend.bill.form')


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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet">

    <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>

    <script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>

    @include('frontend.bill.include.scripts.filter')
    @include('frontend.bill.include.scripts.pagination')
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
            $(document).on('blur', '#cash_received', function() {
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
        // $("#phone_number").autocomplete({
        //     source: function(request, response) {
        //         $.ajax({
        //             url: "{{ route('autoCompletePhone') }}",
        //             type: 'GET',
        //             dataType: "json",
        //             data: {
        //                 search: request.term
        //             },
        //             success: function(data) {
        //                 response(data);
        //             }
        //         });
        //     },
        //     select: function(event, ui) {
        //         console.log('here');
        //         $('#phone_number').val(ui.item.label);
        //         console.log(ui.item);
        //         return false;
        //     }
        // });



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
    </script>
@endsection
