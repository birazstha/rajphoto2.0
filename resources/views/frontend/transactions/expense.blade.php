@extends('frontend.layout.master')
@section('main-content')
    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">Expense</h3>
        </div>

        <form class="form-horizontal" action="{{ route('transactions.store') }}" method="POST" autocomplete="off">
            @csrf
            <div class="card-body">
                {{-- Title --}}
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <select name="expense_id" id="expense_title" class="form-control transaction_title" required>
                            <option value="">Select Title</option>
                            @foreach ($expenses as $expenses)
                                <option value="{{ $expenses->id }}">{{ $expenses->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                {{-- Amount --}}
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Amount</label>
                    <div class="col-sm-10">
                        <input type="number" name="amount" class="form-control" id="inputPassword3" placeholder="Amount"
                            required>
                    </div>
                </div>


                <!--Description-->
                <div class="form-group row d-none" id="toggle-description-income">
                    {!! Form::label('description', 'Description', ['class' => 'col-sm-2 col-form-label']) !!}
                    <div class="col-sm-10">

                        <textarea name="description_income" id="" cols="10" rows="3" class="form-control"></textarea>

                        @error('description')
                            <span class="text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
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

    {{-- <div class="row">
        <div class="col-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Fixed Header Table</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 300px;">
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($transactions as $key => $transaction)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $transaction->expenses->title }}</td>
                                    <td>{{ $transaction->amount }}</td>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div> --}}
@endsection

@section('js')
    <script src="{{ asset('public/compiledCssAndJs/js/transaction.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#expense_title').focus();
        });
    </script>
@endsection
