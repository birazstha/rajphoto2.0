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

<script src="{{ asset('public/compiledCssAndJs/js/dashboard.js') }}"></script>
@endsection
