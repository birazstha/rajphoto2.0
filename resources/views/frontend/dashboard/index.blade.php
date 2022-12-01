@extends('frontend.layout.master')
@section('main-content')
    <div class="d-flex justify-content-between mt-2 mb-2">
        <h2> Transactions</h2>

        <div>
            <button class="btn btn-secondary" id="adjustmentt" data-toggle="modal" data-target="#adjustments"> <i
                    class="fa fa-plus"></i>
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

    </ul>

    @include('frontend.dashboard.adjustment')
    @include('frontend.dashboard.withdraw')

    <table class="table table-striped">
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
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center text-danger"> No Transactions found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $(document).on("keyup", "#closing_balancee", function() {
                var cashInDrawer = $(this).val();
                var closingBalance = $('#closing').val();
                var adjustment = cashInDrawer - closingBalance;
                $('#adjustment').val(adjustment);
            });

            //Focus on Cash on Drawer
            $('#adjustments').on('shown.bs.modal', function() {
                $('#closing_balancee').focus();
            })

        });
    </script>
@endsection
