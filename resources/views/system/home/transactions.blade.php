
<h2> Transactions</h2>
<ul class="list-group">
    <div class="row">
           <!-- ./col -->
           <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>65</h3>
  
                <p>Opening Balance</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

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
        <!-- ./col -->
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
        <!-- ./col -->
        <div class="col-lg-2 col-6">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner">
              <h3> Rs.{{$totalSaving }}/-</h3>

              <p>Savings</p>
            </div>
            <div class="icon">
                <i class="fas fa-piggy-bank"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
     
        <!-- ./col -->
        <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3>65</h3>
  
                <p>Adjustments</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $closingBalance }}</h3>
  
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
