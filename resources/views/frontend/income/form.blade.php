@extends('frontend.layout.master')
@section('main-content')
    <div class="container">
        <div class="row border border-info">
            <div class="col-6 border border-danger">
                1 of 2
            </div>
            <div class="col-6  border border-success">
                2 of 2
            </div>
        </div>
    </div>
    -
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Income</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal">
            <div class="card-body">
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <select name="" id="" class="form-control">

                            <option value="">Select Title</option>

                            @foreach ($orders as $order)
                                <option value="">{{ $order->name }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Amount</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="inputPassword3" placeholder="Amount">
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
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-info">Save</button>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
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

                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('public/compiledCssAndJs/js/transaction.js') }}"></script>
@endsection
