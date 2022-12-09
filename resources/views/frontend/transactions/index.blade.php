@extends('frontend.layout.master')
@section('main-content')
    {{ Session::has('success') }}
    <div class="d-flex justify-content-between mb-2 align-items-center">
        <h2>Transactions</h2>
        <div>

            <button data-toggle="modal" data-target="#bothTransactions" target="_blank"
                class="btn btn-success open-AddBookDialog"><i class="fa fa-plus"></i>&nbspAdd</button>

            {{-- <button data-toggle="modal" data-target="#incomeTransaction" target="_blank"
                class="btn btn-success open-AddBookDialog"><i class="fa fa-plus"></i>&nbspIncome</button>
            <button data-toggle="modal" data-target="#expenseTransaction" target="_blank"
                class="btn btn-danger open-AddBookDialog"><i class="fa fa-plus"></i>&nbspExpenses</button> --}}
        </div>

        @include('frontend.transactions.income')
        @include('frontend.transactions.expense')
        @include('frontend.transactions.form')


    </div>

    {{-- <div class="loader">
            <img src="{{ asset('images/loader.gif') }}" alt="">
        </div> --}}

    <table class="table room-table">
        <thead>
            <tr>
                <th class="text-center">S.No</th>
                <th class="text-center">Title</th>
                <th class="text-center">Amount</th>
            </tr>
        </thead>

        <tbody>

            @forelse ($transactions as $key => $transaction)
                <tr
                    class="{{ $transaction->income_id ? 'table-success' : ($transaction->bill_id ? 'table-success' : ($transaction->saving_id ? 'table-primary' : 'table-danger')) }}">
                    <th class="text-center" scope="row">{{ $key + 1 }}</th>
                    <td class="text-center">
                        @if (isset($transaction->bill_id))
                            Bill ( {{ $transaction->bills->qr_code }})
                        @elseif (isset($transaction->expense_id))
                            {{ $transaction->expenses->title }}
                            {{ $transaction->description ? '(' . $transaction->description . ')' : '' }}
                        @elseif (isset($transaction->saving_id))
                            {{ $transaction->savings->bank_name }}
                        @elseif(isset($transaction->income_id))
                            {{ $transaction->incomes->name }}
                            {{ $transaction->description ? '(' . $transaction->description . ')' : '' }}
                        @endif
                    </td>
                    <td class="text-center">
                        Rs.{{ $transaction->amount }}/-
                    </td>
                </tr>


            @empty
                <tr>
                    <td colspan="3" class="text-danger text-center">No data found.</td>
                </tr>
            @endforelse

        </tbody>

    </table>

    {{ $transactions }}
@endsection
@section('js')
    <script src="{{ asset('public/compiledCssAndJs/js/transaction.js') }}"></script>
@endsection
