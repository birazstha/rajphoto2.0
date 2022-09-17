@extends('frontend.layout.master')
@section('main-content')
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
    </script>

    @include('frontend.bill.include.scripts.filter')
    @include('frontend.bill.include.scripts.pagination')
@endsection
