<div class="d-flex justify-content-between mt-2 mb-2">
    <h2> Transactions</h2>

    <div>
        <button class="btn btn-secondary" data-toggle="modal" data-target="#adjustments"> <i class="fa fa-plus"></i>
            Adjustment</button>
        <button class="btn btn-danger" data-toggle="modal" data-target="#withdraw"> <i class="fa fa-plus"></i>
            Withdraw</button>
    </div>

</div>

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
                    <i class="ion ion-pie-graph"></i>
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

        {{-- Adjustments --}}

        {{-- <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>Rs.{{ $adjustment }}/-</h3>

                    <p>Adjustments</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
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
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        {{-- Closing Balance --}}
        <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>Rs.{{ $closingBalance }}/-</h3>
                    <p>Closing Balance</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>





    <div class="modal fade" id="adjustments" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="{{ route('adjustment.store') }}" method="POST">
                <div class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Adjustment</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label class="form-label" for="">Closing Balance</label>
                            <input type="text" readonly name="closing" id="closing" class="form-control"
                                value="{{ $closingBalance }}">
                        </div>

                        {{-- Cash In drawer --}}
                        <div class="form-group">
                            <label class="form-label" for="">Cash In Drawer</label>
                            <input type="number" class="form-control" name="closing_balance" id="closing_balance"
                                value="">
                        </div>

                        {{-- Adjustment --}}
                        <div class="form-group">
                            <label class="form-label" for="">Adjustment</label>
                            <input type="text" class="form-control" name="adjusted_amount" value=""
                                id="adjustment" readonly>
                        </div>

                        <input type="hidden" class="form-control" value="{{ $todaysDate }}" id="date"
                            name="date">

                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-sm btn-success">
                            <i class="fa fa-save"></i> {{ translate('Save') }}
                        </button>

                        <button type="reset" class="btn btn-sm btn-secondary">
                            <i class="fa fa-save"></i> Clear
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>



    </div>


</ul>

<input type="text" class="form-control mb-3" placeholder="Enter Transaction ID">
<table class="table table-striped">
    <thead class="table-active">
        <tr>
            <th scope="col">S. No</th>
            <th scope="col">Description</th>
            <th scope="col">Amount</th>
            <th scope="col">Action</th>
            {{-- <th scope="col">Cash Flow</th> --}}
            {{-- <th scope="col">Handle</th> --}}
        </tr>
    </thead>
    <tbody>

        @forelse ($transactions as $key => $transaction)
            <tr
                class="{{ $transaction->income_id ? 'table-success' : ($transaction->bill_id ? 'table-success' : ($transaction->saving_id ? 'table-primary' : 'table-danger')) }}">
                <th scope="row">{{ $key + 1 }}</th>
                <td>
                    @if (isset($transaction->bill_id))
                        {{ $transaction->bills->status ? 'Cleared' : 'Prepared' }}
                        Bill ({{ $transaction->bills->qr_code }})
                    @elseif (isset($transaction->expense_id))
                        {{ $transaction->expenses->title }}
                    @elseif (isset($transaction->saving_id))
                        {{ $transaction->banks->bank_name }}
                    @elseif($transaction->is_withdrawn == true)
                        Withdrawn
                    @else
                        {{ $transaction->incomes->name }}
                    @endif
                </td>
                <td>
                    Rs.{{ $transaction->amount }}/-
                </td>
                <td>
                    <button class="btn btn-info" data-toggle="modal"
                        data-target="#editTrasaction{{ $transaction->id }}"><i
                            class="fas fa-pencil-alt"></i></button>
                    <button class="btn btn-danger" data-toggle="modal" data-target="#deleteTransaction"><i
                            class="fas
                        fa-trash"></i></button>
                    @include('system.home.edit')
                    @include('system.home.delete')
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center text-danger"> No Transactions found</td>
            </tr>
        @endforelse

        <!-- Button trigger modal -->




    </tbody>
</table>
