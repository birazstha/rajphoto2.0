@extends('system.layouts.master')
@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            @include('system.partials.message')

            <input type="text" value="" name="todays-date" class="form-control" id="todays-date">

            <div>Today's Income:</div>
            <div id="income"></div>


        </div>

    </div>
@endsection


@section('scripts')
    <script src="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v3.7.min.js"
        type="text/javascript"></script>

    <script>
        $(document).ready(function() {
            var date = NepaliFunctions.ConvertDateFormat(NepaliFunctions.GetCurrentBsDate(), 'YYYY-MM-DD');
            $('#todays-date').nepaliDatePicker({
                language: "english",
                disableDaysAfter: 0,
                disableBefore: "2079-05-24",
                onChange: function() {
                    var selectedDate = $('#todays-date').val();

                    $.ajax({
                        method: 'get',
                        url: "{{ URL::route('bill.getIncome') }}",
                        data: {
                            'date': selectedDate,
                            '_token': "{{ csrf_token() }}"
                        },
                        dataType: 'html',
                        success: function(response) {
                           $('#income').html(response);
                        },
                    });
                }
            });

            $("#todays-date").val(date);


        });
    </script>
@endsection
