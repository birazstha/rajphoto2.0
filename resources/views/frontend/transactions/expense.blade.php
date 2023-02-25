@extends('frontend.layout.master')
@section('main-content')
    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">Expense - {{ $expense->title }}</h3>
        </div>

        <form class="form-horizontal" action="{{ route('transactions.store') }}" method="POST" autocomplete="off">
            @csrf
            <div class="card-body">
                {{-- Title --}}
                <input type="hidden" name="expense_id" value="{{ $expense->id }}">

                {{-- Amount --}}
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Amount</label>
                    <div class="col-sm-10">
                        <input type="number" name="amount" class="form-control" id="expense_amount" placeholder="Amount"
                            required>
                    </div>
                </div>

                {{-- Paid to --}}
                @if ($is_bill_paid)
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Paid To</label>
                        <div class="col-sm-10">
                            <input type="text" name="bill_paid_to" class="form-control"
                                placeholder="Enter Receiver's Name" required>
                        </div>
                    </div>
                @endif

                <!--Description-->
                @if ($is_other)
                    <div class="form-group row" id="toggle-description-income">
                        {!! Form::label('description', 'Description', ['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">

                            <textarea name="description_income" id="" cols="10" rows="3" class="form-control"></textarea>

                            @error('description')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                @endif

                {{-- Date --}}
                <input type="hidden" name="date" class="todays_date" value="">

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-info"><i class="fas fa-plus-circle"></i> Save</button>
                <button type="reset" class="btn btn-secondary"><i class="fas fa-recycle"></i> Clear</button>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
@endsection

@section('js')
    <script src="{{ asset('public/compiledCssAndJs/js/transaction.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#expense_title').focus();
        });
    </script>
@endsection
