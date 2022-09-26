<h1> Rs.{{ collect($transactions)->sum('amount') }}</h1>


<h2> Transactions</h2>
<ul class="list-group">






</ul>
<table class="table table-striped">
    <thead class="table-active">
        <tr>
            <th scope="col">S. No</th>
            <th scope="col">Income/Expense/Savings</th>
            <th scope="col">Amount</th>
            {{-- <th scope="col">Cash Flow</th> --}}
            {{-- <th scope="col">Handle</th> --}}
        </tr>
    </thead>
    <tbody>
        @forelse ($transactions as $key => $transaction)
            <tr
                class="{{ $transaction->income_id ? 'table-success' : ($transaction->bill_id ? 'table-success' : ($transaction->saving_id ? 'table-primary' : 'table-danger' )) }}">
                <th scope="row">{{ $key + 1 }}</th>
                <td>
                    @if (isset($transaction->bill_id))
                        Bill ( {{ $transaction->bills->qr_code }})
                    @elseif (isset($transaction->expense_id))
                        {{ $transaction->expenses->title }}
                    @elseif (isset($transaction->saving_id))
                        {{ $transaction->savings->bank_name }}
                    @else
                        {{ $transaction->incomes->name }}
                    @endif
                </td>
                <td>
                    Rs.{{ $transaction->amount }}/-
                </td>

            </tr>

        @empty
            <tr>
                <td colspan="3" class="text-center text-danger"> No Transactions found</td>
            </tr>
        @endforelse


    </tbody>
</table>
