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

        <a href="{{ route('other-incomes.create') }}">
            <section class="icon">
                <i class="fas fa-money-bill-wave"></i>
                <span>Other Incomes</span>
            
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


