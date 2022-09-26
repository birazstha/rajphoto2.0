
  <form action="{{ route('expense.store') }}" method="POST" autocomplete="off" id="form">
    @csrf
    <!--Prepared by-->
    <div class="form-group row">
        {!! Form::label('expense_id', 'Expense', ['class' => 'col-sm-2 col-form-label']) !!}
        <div class="col-sm-10">

            <select name="expense_id" id="other" class="form-control" required>
                <option value="" selected>Select Expense Title</option>
                @foreach ($expenses as $expense)
                    <option value="{{ $expense->id }}">{{ $expense->title }}</option>
                @endforeach
            </select>

            @error('expense_id')
                <span class="text text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

        <!--Amount-->
        <div class="form-group row">
            {!! Form::label('amount', 'Amount', ['class' => 'col-sm-2 col-form-label']) !!}
            <div class="col-sm-10">
                <input type="number" name="amount" value="" id="amount"
                class="form-control">
                @error('amount')
                    <span class="text text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    


    {{-- <div class="row">
        <div class="col-6">
            <!--Cash Received-->
            <div class="form-group row">
                <label for="order_date" class="col-sm-4 col-form-label">Cash Received</label>
                <div class="col-sm-8">
                    <input type="number" name="cash_received" value="{{ $item->cash_received ?? '' }}"
                        id="other_cash_received" class="form-control" required>
                </div>
            </div>

        </div>
        <div class="col-6">
            <!--Cash Return-->
            <div class="form-group row">
                <label for="texr" class="col-sm-4 col-form-label">Cash Return</label>
                <div class="col-sm-8">
                    <input type="text" name="cash_return" value="{{ $item->cash_return ?? '' }}"
                        id="other_cash_return" class="form-control" readonly>
                </div>
            </div>
            @error('delivery_date')
                <span class="text text-danger">{{ $message }}</span>
            @enderror
        </div>

     
    </div> --}}

    <input type="hidden" name="date" class="order-date" value="">

    <button class="btn btn-success btn-sm"><i class="fas fa-save"></i> Save</button>
    <button type="reset" class="btn btn-secondary btn-sm"><i class="fas fa-recycle"></i> Reset</button>
</form>