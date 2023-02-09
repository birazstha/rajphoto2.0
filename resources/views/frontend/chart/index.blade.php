@extends('frontend.layout.master')
@section('main-content')
    <h1>Bills</h1>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">No. of Transactions</th>
                <th scope="col">Total Amount</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bills as $key => $transaction)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>

                        {{ isset($transaction->sizes) ? $transaction->sizes->orders->name . '(' . $transaction->sizes->name . ')' : '' }}
                    </td>
                    <td> {{ $transaction->count ?? '' }}</td>
                    <td>Rs. {{ $transaction->total_amount }}/-</td>

                </tr>
            @empty
                <tr>
                    <td class="text text-danger text-center" colspan="5">No data available</td>
                </tr>
            @endforelse

        </tbody>
    </table>

    <br>
    <h1>Incomes</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">No. of Transactions</th>
                <th scope="col">Total Amount</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transactions as $key => $transaction)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>
                        {{ $transaction->incomes->name ?? '' }}
                    </td>
                    <td> {{ $transaction->count ?? '' }}</td>
                    <td>Rs. {{ $transaction->total_amount }}/-</td>

                </tr>
            @empty
                <tr>
                    <td class="text text-danger text-center" colspan="5">No data available</td>
                </tr>
            @endforelse



        </tbody>
    </table>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');
        var bills = @json($bills);
        var labels = Object.keys(bills);
        var values = Object.values(bills);
        console.log(labels);


        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: '# of Votes',
                    data: values,
                    borderWidth: 1
                }]
            },

        });
    </script>
@endsection
