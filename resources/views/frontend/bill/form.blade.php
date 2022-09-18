@extends('frontend.layout.master')
@section('main-content')




    <div class="form">
        <div class="tab-slider--nav">
            <ul class="tab-slider--tabs">
                <li class="tab-slider--trigger active" rel="tab1">Bill</li>
                <li class="tab-slider--trigger" rel="tab2">General</li>
            </ul>
        </div>
        <div class="tab-slider--container">
                @include('frontend.bill.include.bill')
            <div id="tab2" class="tab-slider--body">
              @include('frontend.bill.include.other')
            </div>
        </div>

        {{-- {{ Form::open(['route' => 'bills.store']) }} --}}


    </div>

@endsection


@section('js')
    @include('frontend.bill.include.scripts.script')

    <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet">
    <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
    <script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>

    {{-- For nepali date picker --}}
    <script src="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v3.7.min.js"
        type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>


    <script type="text/javascript">
        window.onload = function() {
            $('#order-date').nepaliDatePicker({
                language: "english",
            });
            var currentBsDate = NepaliFunctions.ConvertDateFormat(NepaliFunctions.GetCurrentBsDate(), 'YYYY-MM-DD');
            $('#order-date').val(currentBsDate);

            //Delivery date
            $('#delivery-date').nepaliDatePicker({
                language: "english",
            });
            var deliveryDate = NepaliFunctions.ConvertDateFormat(NepaliFunctions.BsAddDays(NepaliFunctions
                .GetCurrentBsDate(), 1), 'YYYY-MM-DD')
            $('#delivery-date').val(deliveryDate);

        };

        //Auto complete f


        $("#phone_number").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "{{ route('autocompletePhone') }}",
                    type: 'GET',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function(data) {
                        response(data);
                    },
                });
            },
            delay: 200,
            select: function(event, ui) {
                $('#phone_number').val(ui.item.label);
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
    </script>
@endsection
