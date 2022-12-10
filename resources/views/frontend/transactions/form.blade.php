<div class="modal fade" id="bothTransactions" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Record Transaction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{ route('transactions.store') }}" method="POST" autocomplete="off">
                    @csrf
                    <!--Income Title-->
                    <div class="form-group row">
                        {!! Form::label('order_id', 'Transaction Type', ['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                            <select name="transaction_type" id="transaction-type" class="form-control transaction-type"
                                required>
                                <option value="">Select Transaction Type</option>
                                <option value="income" selected>Income</option>
                                <option value="expense">Expense</option>
                            </select>

                            @error('transaction_type')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!--Title-->
                    <div class="form-group row">
                        {!! Form::label('transaction_title_id', 'Title', ['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                            <select name="transaction_title_id" id="transaction_title"
                                class="form-control transaction_title" required>
                                <option value="" selected>Select Income Title</option>
                            </select>

                            @error('transaction_title_id')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!--Description-->
                    <div class="form-group row d-none" id="toggle-description-income">
                        {!! Form::label('description', 'Description', ['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">

                            <textarea name="description" id="" cols="10" rows="3" class="form-control" name="description"></textarea>

                            @error('description')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>




                    <div class="toggle-income">
                        <!--Rate-->
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group row">
                                    {!! Form::label('grand_total', 'Rate', ['class' => 'col-sm-6 col-form-label']) !!}
                                    <div class="col-sm-6">
                                        <td><input type="number" name="rate" value="" id="other_rate"
                                                class="form-control">
                                        </td>
                                    </div>
                                </div>
                            </div>

                            <!--Quantity-->
                            <div class="col-4">
                                <div class="form-group row">
                                    {!! Form::label('paid_amount', 'Quantity', ['class' => 'col-sm-3 col-form-label']) !!}
                                    <div class="col-sm-6">
                                        <td><input type="number" name="quantity" value="1" id="other_quantity"
                                                class="form-control" {{ isset($item) ? 'readonly' : '' }} required>
                                        </td>
                                    </div>
                                </div>
                                @error('paid_amount')
                                    <p class="text text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-4">
                                <!--Total-->
                                <div class="form-group row">
                                    {!! Form::label('total', 'Total', ['class' => 'col-sm-4 col-form-label']) !!}
                                    <div class="col-sm-6">
                                        <td><input type="text" name="total" id="other_total"
                                                value="{{ $item->due_amount ?? '' }}" readonly class="form-control">
                                        </td>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!--Description-->
                        <div class="form-group row d-none" id="toggle-description-expense">
                            {!! Form::label('description', 'Description', ['class' => 'col-sm-2 col-form-label']) !!}
                            <div class="col-sm-10">

                                <textarea name="description" id="" cols="10" rows="3" class="form-control" name="description"></textarea>

                                @error('description')
                                    <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>



                        <!--Payment Method-->
                        <div class="form-group row" id="toggle-payment-method-other">
                            {!! Form::label('', 'Payment Method', ['class' => 'col-sm-2 col-form-label']) !!}
                            <div class="col-sm-10">

                                <select name="" class="form-control payment_method_other"
                                    id="payment_method_other" required>
                                    <option value="cash" selected>Cash</option>
                                    <option value="online">Online</option>
                                </select>
                            </div>
                        </div>

                    </div>


                    <!--Amount-->
                    <div class="toggle-expense d-none">
                        <div class="form-group row">
                            {!! Form::label('amount', 'Amount', ['class' => 'col-sm-2 col-form-label']) !!}
                            <div class="col-sm-10">
                                <input type="number" name="amount" value="" id="amount" class="form-control">
                                @error('amount')
                                    <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="date" class="current_date" value="">



                    {{-- Payment Gateway --}}
                    <div class="form-group row toggle-payment-other d-none" id="toggle-payment-other">
                        {!! Form::label('payment_method', 'Payment Gateway', ['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10" style="display: flex; flex-direction:row; align-item:center">
                            @foreach ($payments as $payment)
                                <div class="form-check" style="display: flex; align-items:center;">
                                    <input class="form-check-input" name="payment_gateway" type="radio"
                                        id="flexRadioDefault1" value="{{ $payment->id }}">
                                    <label class="form-check-label mr-2" for="flexRadioDefault1">
                                        <img src="{{ asset('public/uploads/payment-method/' . $payment->image) }}"
                                            height="50px" alt="">
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>



                    {{-- <div class="row" id="cash-transaction-other">
                        <div class="col-6">
                            <!--Cash Received-->
                            <div class="form-group row">
                                <label for="order_date" class="col-sm-4 col-form-label">Cash Received</label>
                                <div class="col-sm-8">
                                    <input type="number" name="cash_received"
                                        value="{{ $item->cash_received ?? '' }}" id="other_cash_received"
                                        class="form-control">
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

                    <button class="btn btn-success btn-sm"><i class="fas fa-save"></i> Save</button>
                    <button type="reset" class="btn btn-secondary btn-sm"><i class="fas fa-recycle"></i>
                        Reset</button>
                </form>

            </div>

        </div>
    </div>
</div>
