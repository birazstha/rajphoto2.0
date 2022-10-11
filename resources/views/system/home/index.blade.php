@extends('system.layouts.master')
@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            @include('system.partials.message')
            <input type="text" value="" name="todays-date" class="form-control" id="todays-date">
     
            <div id="income"></div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        const getIncomeInfo = function(data) {
            $.ajax({
                method: 'get',
                url: "{{ URL::route('bill.getIncome') }}",
                data: {
                    'date': data,
                    '_token': "{{ csrf_token() }}"
                },
                dataType: 'html',
                success: function(response) {
                    $('#income').html(response);
                },
            });
        };

        $(document).ready(function() {
            var todaysDate = NepaliFunctions.ConvertDateFormat(NepaliFunctions.GetCurrentBsDate(), 'YYYY-MM-DD');
            getIncomeInfo(todaysDate);

            $('#todays-date').nepaliDatePicker({
                language: "english",
                disableDaysAfter: 0,
                disableBefore: "2079-05-24",
                onChange: function() {
                    var selectedDate = $('#todays-date').val();
                    getIncomeInfo(selectedDate);

                }
            });
            $("#todays-date").val(todaysDate);
        });
    </script>
@endsection
