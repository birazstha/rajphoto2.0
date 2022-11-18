@extends('system.layouts.master')
@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            @include('system.partials.message')
            <input type="text" name="todays-date" class="form-control" id="todays-date">

            <input type="hidden" name="yesterday-date" class="form-control" id="yesterday-date">


            <div id="income"></div>

            {{-- <div class="loader">
                <img src="{{ asset('public/images/loader.gif') }}" alt="">
            </div> --}}
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('public/compiledCssAndJs/js/dashboard.js') }}"></script>
@endsection
