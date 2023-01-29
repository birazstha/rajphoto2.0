@extends('frontend.layout.master')
@section('main-content')
    <h1>Bills</h1>
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
            {{-- @foreach ($others as $key => $transaction)
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
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>
                        {{ $transaction->sizes->name ?? '' }} (
                        {{ $transaction->sizes->orders->name ?? '' }}
                        )
                    </td>
                    <td> {{ $transaction->count ?? '' }}</td>
                    <td>Rs. {{ $transaction->total_amount }}/-</td>

                </tr>
            @endforeach

        </tbody>
    </table>

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
            {{-- @foreach ($others as $key => $transaction)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>
                        {{ $transaction->incomes->name ?? '' }} {{ $transaction->sizes ?? '' }}
                    </td>
                    <td> {{ $transaction->count ?? '' }}</td>
                    <td>Rs. {{ $transaction->total_amount }}/-</td>

                </tr>
            @endforeach --}}

            @foreach ($others as $key => $transaction)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>
                        {{ $transaction->sizes->name ?? '' }} (
                        {{ $transaction->sizes->orders->name ?? '' }}
                        )
                    </td>
                    <td> {{ $transaction->count ?? '' }}</td>
                    <td>Rs. {{ $transaction->total_amount }}/-</td>

                </tr>
            @endforeach

        </tbody>
    </table>
@endsection
