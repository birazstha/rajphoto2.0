@extends('frontend.layout.master')
@section('main-content')
    <h1>Todays Analytics</h1>

    <div class="row border border-success">
        <div class="col">
            <div style="height:500px">
                <canvas id="myChart"></canvas>
            </div>
        </div>
        <div class="col">
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
                    @forelse ($test as $key => $income)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>
                                {{ isset($income->size_id) ? $income->sizes->orders->name . '(' . $income->sizes->name . ')' : $income->incomes->name }}
                            </td>
                            <td> {{ $income->count ?? '' }}</td>
                            <td>Rs. {{ $income->total_amount }}/-</td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text text-danger text-center" colspan="5">No data available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');
        var bills = @json($incomes);
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
