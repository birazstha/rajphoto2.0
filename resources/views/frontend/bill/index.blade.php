@extends('frontend.layout.master')
@section('main-content')
    {{ Session::has('success') }}


    <div class="bill-index">
        <div class="mb-4">


            <form class="d-flex">
                @csrf
                <div class="input-group input-group">
                    <input type="text" class="form-control customerName"
                        placeholder="Enter Customer's Name or Phone number">
                    <span class="input-group-append">
                        <input type="text" value="" name="todays-date" class="form-control text-center"
                            id="todays-date">
                    </span>
                </div>

            </form>


        </div>

        <div class="d-flex justify-content-between mb-2 align-items-center">
            <h2>Bills</h2>
            <button data-toggle="modal" data-target="#createBill" target="_blank"
                class="btn btn-success open-AddBookDialog"><i class="fa fa-plus"></i>&nbspCreate</button>

            @include('frontend.bill.include.create')

        </div>





        <div class="loader">
            <img src="{{ asset('images/loader.gif') }}" alt="">
        </div>

        <div id="table"></div>
    </div>
@endsection
@section('js')
    <script src="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v3.7.min.js"
        type="text/javascript"></script>
    <script src="http://benalman.com/code/projects/jquery-throttle-debounce/jquery.ba-throttle-debounce.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>


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
        $("input[name='phone_number']").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "{{ route('autocompletePhone') }}",
                    type: 'GET',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function(data) {
                        console.log(data);
                        response(data);
                    },
                });
            },
            delay: 200,
            select: function(event, ui) {
                $("input[name='phone_number']").val(ui.item.label);
                console.log(ui.item);
                return false;
            },
        });

        var path = "{{ route('autocompleteName') }}";
        $("#customer_name").typeahead({
            source: function(query, process) {
                return $.get(path, {
                    query: query
                }, function(data) {
                    console.log(data);
                    return process(data);
                });
            }
        });
    </script>
@endsection
