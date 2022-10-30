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
            @include('frontend.transactions.include.income')

        </div>
        <div id="tab2" class="tab-slider--body">

            {{-- Expenses --}}
          @include('frontend.transactions.include.expense')
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
