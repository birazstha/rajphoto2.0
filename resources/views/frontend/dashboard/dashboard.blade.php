<ul class="list-group">
    <div class="row">

        {{-- Opening Balance --}}
        <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    {{-- <h3>Rs. {{ $openingBalance }}/-</h3> --}}
                    <h3>Rs. {{ $openingBalance }}/-</h3>
                    <p>Opening Balance</p>
                </div>
                <div class="icon">
                    <i class="fas fa-cloud-sun"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        {{-- Income --}}

        <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>Rs.{{ $totalIncome }}/-</h3>
                    <p>Income</p>
                </div>
                <div class="icon">
                    <i class="fas fa-hand-holding-usd"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>


        {{-- Expense --}}
        <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3> Rs.{{ $totalExpense }}/-</h3>

                    <p>Expense</p>
                </div>
                <div class="icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <a href="#" class="small-box-footer">More info
                    <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        {{-- Savings --}}
        <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3> Rs.{{ $totalSaving }}/-</h3>

                    <p>Savings</p>
                </div>
                <div class="icon">
                    <i class="fas fa-piggy-bank"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        {{-- Online Payment --}}
        {{-- <div class="col-lg-2 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>Rs.{{ $totalOnlinePayment }}/-</h3>

                        <p>Online Payment</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div> --}}


        {{-- With Drawn --}}
        <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>Rs.{{ $withdrawn }}/-</h3>
                    <p>With Drawn</p>
                </div>
                <div class="icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        {{-- Adjustments --}}
        {{-- <div class="col-lg-2 col-6">
                <!-- small box -->
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>Rs.{{ $adjustment }}/-</h3>

                        <p>Adjustments</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-balance-scale"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div> --}}

        {{-- Closing Balance --}}
        <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>Rs.{{ $closingBalance }}/- {!! $adjustment
                        ? ($adjustment > 0
                            ? "<span style='color:green'> [" . $adjustment . ']</span>'
                            : "<span class='text text-danger'> [" . $adjustment . ']</span>')
                        : '' !!}</h3>
                    <p>Closing Balance </p>

                </div>
                <div class="icon">
                    <i class="fas fa-cloud-moon"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
</ul>


<div class="row">

    <div class="col-6">
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Analytics</h3>
                {{-- <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <div class="input-group-append">
                            <select class="form-select"
                                onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                                <option value="{{ route('home') }}" selected>All</option>
                                <option value="{{ route('filter.trasactions', 'bill') }}"
                                    {{ request()->segment(2) == 'bill' ? 'selected' : '' }}>Bill</option>

                                <option value="{{ route('filter.trasactions', 'income') }}"
                                    {{ request()->segment(2) == 'income' ? 'selected' : '' }}>Incomes</option>
                                <option value="{{ route('filter.trasactions', 'expense') }}"
                                    {{ request()->segment(2) == 'expense' ? 'selected' : '' }}>Expenses
                                </option>
                                <option value="{{ route('filter.trasactions', 'savings') }}"
                                    {{ request()->segment(2) == 'savings' ? 'selected' : '' }}>Savings</option>
                                <option value="{{ route('filter.trasactions', 'online-payment') }}"
                                    {{ request()->segment(2) == 'online-payment' ? 'selected' : '' }}>Online
                                    Payment
                                </option>
                            </select>
                        </div>
                    </div>
                </div> --}}
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 535px;">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">No. of Transactions</th>
                            <th scope="col">Total Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($analytics['test'] as $key => $income)
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
                                <td class="text text-danger text-center" colspan="5">No data available
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="col-6">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Transactions</h3>
                <div class="card-tools">
                    {{-- <div class="input-group input-group-sm" style="width: 150px;">
                        <div class="input-group-append">
                            <select class="form-select"
                                onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                                <option value="{{ route('home') }}" selected>All</option>
                                <option value="{{ route('filter.trasactions', 'bill') }}"
                                    {{ request()->segment(2) == 'bill' ? 'selected' : '' }}>Bill</option>

                                <option value="{{ route('filter.trasactions', 'income') }}"
                                    {{ request()->segment(2) == 'income' ? 'selected' : '' }}>Incomes</option>
                                <option value="{{ route('filter.trasactions', 'expense') }}"
                                    {{ request()->segment(2) == 'expense' ? 'selected' : '' }}>Expenses
                                </option>
                                <option value="{{ route('filter.trasactions', 'savings') }}"
                                    {{ request()->segment(2) == 'savings' ? 'selected' : '' }}>Savings</option>
                                <option value="{{ route('filter.trasactions', 'online-payment') }}"
                                    {{ request()->segment(2) == 'online-payment' ? 'selected' : '' }}>Online
                                    Payment
                                </option>
                            </select>
                        </div>
                    </div> --}}
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 535px;">
                <table class="table table-head-fixed text-nowrap">
                    <thead class="table-active">
                        <tr>
                            <th scope="col">S. No</th>
                            <th scope="col">Descriptions</th>
                            <th scope="col">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
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
                                            <a href="{{ route('bills.show', $transaction->bills->qr_code) }}"
                                                target="_blank"><i class="fas fa-print"></i></a>
                                        </p>
                                    @elseif (isset($transaction->expense_id))
                                        {{ $transaction->expenses->title }}
                                        {{ isset($transaction->description) ? '(' . $transaction->description . ')' : '' }}
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
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>

</div>



<script>
    const ctx = document.getElementById('myChart');
    var bills = @json($pie_chart);
    var labels = Object.keys(bills);
    var values = Object.values(bills);
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
