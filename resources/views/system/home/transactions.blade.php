<h1> Rs.{{ collect($transactions)->sum('amount') }}</h1>


<h2> Transactions</h2>
<ul class="list-group">

    @foreach ($transactions as $key => $transaction)
        <li class="list-group-item list-group-item-success">

            @if (isset($transaction->bills->qr_code))
                {{ $key + 1 }}. Rs.{{ $transaction->amount }} collected from Bill No.
                {{ $transaction->bills->qr_code }}
            @else
                {{ $key + 1 }}. Rs.{{ $transaction->amount }} collected from {{ $transaction->incomes->name }}
            @endif
        </li>
    @endforeach

</ul>
