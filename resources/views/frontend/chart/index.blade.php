@extends('frontend.layout.master')
@section('main-content')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">No of Orders</th>
                <th scope="col">Total Amount</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($transactions as $key => $transaction)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>
                        {{ $transaction->incomes->name ?? '' }} {{ $transaction->sizes ?? '' }}
                    </td>
                    <td> {{ $transaction->count ?? '' }}</td>
                    <td>Rs. {{ $transaction->total_amount }}/-</td>

                </tr>
            @endforeach --}}

            @foreach ($transactions as $key => $transaction)
                {{-- @dump($transaction) --}}
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>
                        {{ $transaction->incomes->name ?? '' }}
                    </td>
                    <td> {{ $transaction->count ?? '' }}</td>
                    <td>Rs. {{ $transaction->total_amount }}/-</td>

                </tr>
            @endforeach

        </tbody>
    </table>
@endsection
