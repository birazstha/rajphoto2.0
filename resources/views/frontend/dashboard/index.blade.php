@extends('frontend.layout.master')
@section('main-content')
    <h1 style="text-align: center">Bills</h1>

    <div class="dashboard">
        <a href="{{ route('bills.index') }}">
            <section class="icon">
                <i class="fas fa-file-invoice"></i>
                <span>Bills</span>
              
            </section>
        </a>

        <a href="{{ route('transactions.index') }}">
            <section class="icon">
                <i class="fas fa-money-bill-wave"></i>
                <span>Income/Expenses</span>
            </section>
        </a>

        <a href="{{ route('saving.index') }}">
            <section>
                <i class="fas fa-piggy-bank"></i>
                <span>Savings</span>
            </section>
        </a>

        <a href="{{ route('bill.qrcode') }}">
            <section>
                <i class="fas fa-qrcode"></i>
                <span>QR Code</span>
            </section>
        </a>
    </div>
@endsection


