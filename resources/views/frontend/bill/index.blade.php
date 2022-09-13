@extends('frontend.layout.master')
@section('main-content')
    <div class="bill-index">
        <div class="mb-4">
            <form class="d-flex">
                @csrf
                <div class="input-group input-group">
                    <input type="text" class="form-control customerName" placeholder="Enter a custome's name">
                    <span class="input-group-append">
                        <input type="text" value="" name="todays-date" class="form-control text-center"
                            id="todays-date">
                    </span>
                </div>

            </form>
        </div>
        @include('frontend.bill.include.modal')
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

    @include('frontend.bill.include.scripts.filter')
    @include('frontend.bill.include.scripts.pagination')
@endsection
