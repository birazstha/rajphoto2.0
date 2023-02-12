@extends('frontend.layout.master')
@section('main-content')
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Income</h3>
        </div>

        <form class="form-horizontal" action="{{ route('transactions.store') }}" method="POST" autocomplete="off">
            @csrf

            <input type="hidden" name="date" id="todays_date" value="">

            <div class="card-body">

                {{-- Title --}}
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <select name="income_id" id="income_title" class="form-control transaction_title">
                            <option value="">Select Title</option>
                            @foreach ($orders as $order)
                                <option value="{{ $order->id }}">{{ $order->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Size --}}
                <div class="form-group row d-none toggle-size">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Size</label>
                    <div class="col-sm-10">
                        <select name="size_id" id="transaction_title" class="form-control size_title">
                            <option value="">Select Size</option>
                            @foreach ($sizes as $size)
                                <option value="{{ $size->id }}">{{ $size->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                {{-- Amount --}}
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Amount</label>
                    <div class="col-sm-10">
                        <input type="number" name="amount" class="form-control" id="income_amount" placeholder="Amount"
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

                <!--Payment Method-->
                <div class="form-group row" id="toggle-payment-method-other">
                    {!! Form::label('', 'Payment Method', ['class' => 'col-sm-2 col-form-label']) !!}
                    <div class="col-sm-10">

                        <select name="" class="form-control payment_method_other" id="payment_method_other" required>
                            <option value="cash" selected>Cash</option>
                            <option value="online">Online</option>
                        </select>
                    </div>
                </div>

                {{-- Payment Gateway --}}
                <div class="form-group row toggle-payment-other d-none" id="toggle-payment-other">
                    {!! Form::label('payment_method', 'Payment Gateway', ['class' => 'col-sm-2 col-form-label']) !!}
                    <div class="col-sm-10" style="display: flex; flex-direction:row; align-item:center">
                        @foreach ($payments as $payment)
                            <div class="form-check" style="display: flex; align-items:center;">
                                <input class="form-check-input" name="payment_gateway" type="radio" id="flexRadioDefault1"
                                    value="{{ $payment->id }}">
                                <label class="form-check-label mr-2" for="flexRadioDefault1">
                                    <img src="{{ asset('public/uploads/payment-method/' . $payment->image) }}"
                                        height="50px" alt="">
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-info"><i class="fas fa-plus-circle"></i> Save</button>
                <button type="reset" class="btn btn-secondary"><i class="fas fa-recycle"></i> Clear</button>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script src="{{ asset('public/compiledCssAndJs/js/transaction.js') }}"></script>
@endsection
