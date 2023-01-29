@extends('frontend.layout.master')
@section('main-content')
    {{ $elections }}

    <div class="w-25" style="">
        <canvas id="myChart"></canvas>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');
        var elections = @json($elections);
        var labels = Object.keys(elections);
        var values = Object.values(elections);
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
