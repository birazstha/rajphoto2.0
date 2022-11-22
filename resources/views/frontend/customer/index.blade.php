@extends('frontend.layout.master')
@section('main-content')
    {{ Session::has('success') }}
        <div class="d-flex justify-content-between mb-2 align-items-center">
            <h2>{{ $customers->name }} ({{ $customers->phone_number }})
            </h2>
            <div>
                <button data-toggle="modal" data-target="#savings" target="_blank" class="btn btn-success open-AddBookDialog"><i
                        class="fa fa-plus"></i>&nbspIncome</button>
            </div>

        </div>

        <div>
            hello

            
            {{ $bills }}

        </div>

        
@endsection
@section('js')
    <script src="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v3.7.min.js"
        type="text/javascript"></script>
    <script>
        var currentBsDate = NepaliFunctions.ConvertDateFormat(NepaliFunctions.GetCurrentBsDate(), 'YYYY-MM-DD');
        $('.order-date').val(currentBsDate);
    </script>
@endsection
