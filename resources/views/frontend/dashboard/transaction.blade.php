@forelse ($transactions as $key => $transaction)
    <tr
        class="{{ $transaction->income_id ? 'table-success' : ($transaction->bill_id ? 'table-success' : ($transaction->saving_id ? 'table-primary' : 'table-danger')) }}">
        <th scope="row">{{ $key + 1 }}</th>
        <td>
            @if (isset($transaction->bill_id))
                <p class="html-tooltip" data-toggle="tooltip" data-placement="right"
                    title="<div class='text-left'>
                                <p>Name: {{ $transaction->bills->customers->name }}</p>
                                <p>Transaction ID:  {{ $transaction->id }}</p>
                                <p>Payment Gateway: {{ $transaction->payment_gateway ? 'Online' : 'Cash' }}</p>
                                </div>"
                    data-html="true" style="cursor: pointer;">
                    {{ $transaction->bills->status ? 'Cleared' : 'Prepared' }}
                    Bill ({{ $transaction->bills->customers->name }})
                    <a href="{{ route('bills.show', $transaction->bills->qr_code) }}" target="_blank"><i
                            class="fas fa-print"></i></a>
                </p>
            @elseif (isset($transaction->expense_id))
                {{ $transaction->expenses->title }}
                {{ isset($transaction->description) ? '(' . $transaction->description . ')' : '' }}
                {{ isset($transaction->bill_paid_to) ? '(' . ucwords($transaction->bill_paid_to) . ')' : '' }}
            @elseif (isset($transaction->saving_id))
                {{ $transaction->banks->bank_name }}
            @elseif($transaction->is_withdrawn == true)
                Withdrawn
            @else
                <p class="html-tooltip w-25" data-toggle="tooltip" data-placement="right"
                    title=" <div class='text-left'>
                        <p>Transaction ID: {{ $transaction->id }}</p>
                        <p>Payment Gateway: {{ $transaction->payment_gateway ? 'Online' : 'Cash' }}</p>
                        </div>"
                    data-html="true" style="cursor: pointer;">
                    {{ $transaction->incomes->name }}
                    {{ isset($transaction->description) ? '(' . $transaction->description . ')' : '' }}
                </p>
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
