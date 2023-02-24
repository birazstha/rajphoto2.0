@extends('frontend.layout.master')
@section('main-content')
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Income - {{ $income->name }}</h3>
        </div>

        <form class="form-horizontal" action="{{ route('transactions.store') }}" method="POST" autocomplete="off">
            @csrf

            <input type="hidden" name="date" class="todays_date" value="">

            <div class="card-body">

                {{-- Title --}}
                {{-- <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <select name="income_id" id="income_title" class="form-control transaction_title">
                            <option value="">Select Title</option>
                            @foreach ($orders as $order)
                                <option value="{{ $order->id }}">{{ $order->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}
                <input type="hidden" value="{{ $income->id }}" name="income_id">

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



                @if ($is_other)
                    <!--Description-->
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


    {{-- <div class="card">
        <div class="card-header">
            <h3 class="card-title">Fixed Header Table</h3>

            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 300px;">
            <table class="table table-head-fixed text-nowrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Reason</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>183</td>
                        <td>John Doe</td>
                        <td>11-7-2014</td>
                        <td><span class="tag tag-success">Approved</span></td>
                        <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                    </tr>
                    <tr>
                        <td>219</td>
                        <td>Alexander Pierce</td>
                        <td>11-7-2014</td>
                        <td><span class="tag tag-warning">Pending</span></td>
                        <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                    </tr>
                    <tr>
                        <td>657</td>
                        <td>Bob Doe</td>
                        <td>11-7-2014</td>
                        <td><span class="tag tag-primary">Approved</span></td>
                        <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                    </tr>
                    <tr>
                        <td>175</td>
                        <td>Mike Doe</td>
                        <td>11-7-2014</td>
                        <td><span class="tag tag-danger">Denied</span></td>
                        <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                    </tr>
                    <tr>
                        <td>134</td>
                        <td>Jim Doe</td>
                        <td>11-7-2014</td>
                        <td><span class="tag tag-success">Approved</span></td>
                        <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                    </tr>
                    <tr>
                        <td>494</td>
                        <td>Victoria Doe</td>
                        <td>11-7-2014</td>
                        <td><span class="tag tag-warning">Pending</span></td>
                        <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                    </tr>
                    <tr>
                        <td>832</td>
                        <td>Michael Doe</td>
                        <td>11-7-2014</td>
                        <td><span class="tag tag-primary">Approved</span></td>
                        <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                    </tr>
                    <tr>
                        <td>982</td>
                        <td>Rocky Doe</td>
                        <td>11-7-2014</td>
                        <td><span class="tag tag-danger">Denied</span></td>
                        <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div> --}}
@endsection

@section('js')
    <script src="{{ asset('public/compiledCssAndJs/js/transaction.js') }}"></script>
@endsection
