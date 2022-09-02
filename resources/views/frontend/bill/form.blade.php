@extends('frontend.layout.master')
@section('main-content')
    <div class="form">
        <div class="table">
            <div class="table-responsive">
                {{ Form::open(['route'=>'bills.store']) }}
                <!--Name-->
                <div class="form-group row">

                    {!! Form::label('name', 'Name', ['class' => 'col-sm-2 col-form-label']) !!}
                    <div class="col-sm-10">
                        <td><input type="text" name="name" value="{{ $item->name ?? '' }}" id="name"
                                class="form-control" {{ isset($item) ? 'readonly' : '' }}></td>
                        @error('name')
                            <span class="text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- For delivery --}}
                @if (isset($item->billOrders))
                    @foreach ($item->billOrders as $key => $bill)
                        <div class="dynamic-input">
                            <div class="row">
                                <!--Order-->

                                {!! Form::label('order_id', 'Order', ['class' => 'col-sm-2 col-form-label']) !!}
                                <div class="col-sm-2">
                                    <select name="bill[0][order_id]" id="1" class="form-control order"
                                        {{ isset($item) ? 'disabled' : '' }}>
                                        <option value="" selected>Select Order Type</option>
                                        @foreach ($orders as $order)
                                            <option value="{{ $bill->order_id }}" selected>{{ $bill->orders->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>



                                <!--Size-->
                                <div class="col-2 form-group row">
                                    {!! Form::label('size_id', 'Size', ['class' => 'col-sm-3 col-form-label']) !!}
                                    <div class="col-sm-9">
                                        <select name="bill[0][size_id]" id="size_id_1" class="form-control" disabled>
                                            <option value="{{ $bill->size_id }}" selected>{{ $bill->sizes->name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <!--Rate-->
                                <div class="col-2 form-group row">
                                    {!! Form::label('rate', 'Rate', ['class' => 'col-sm-3 col-form-label']) !!}
                                    <div class="col-sm-9">
                                        <input type="number" name="bill[0][rate]" id="rate1" data-id="1"
                                            value="{{ $bill->rate ?? '' }}" {{ isset($item) ? 'readonly' : '' }}
                                            class="form-control">
                                        @error('rate')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!--Quantity-->
                                <div class="col-2 form-group row">
                                    {!! Form::label('quantity', 'Quantity', ['class' => 'col-sm-4 col-form-label']) !!}
                                    <div class="col-sm-8">
                                        <input type="number" name="bill[0][quantity]" id="quantity1" data-id="1"
                                            value="{{ $bill->quantity ?? '' }}" {{ isset($item) ? 'readonly' : '' }}
                                            value="1" class="form-control">
                                        @error('quantity')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>



                                <!--Total-->
                                <div class="col-2 form-group row">
                                    {!! Form::label('total', 'Total', ['class' => 'col-sm-3 col-form-label']) !!}
                                    <div class="col-sm-9">
                                        <input type="text" name="bill[0][total]" id="total1"
                                            value="{{ $bill->total ?? '0' }}" readonly class="form-control"> @error('rate')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                            </div>

                            {{-- For cloning --}}

                            <div class="more-inputs"></div>

                        </div>
                    @endforeach
                    {{-- For creating new bill --}}
                @else
                    <div class="dynamic-input">
                        <div class="row" id="order-1">
                            <!--Order-->

                            {!! Form::label('order_id', 'Order', ['class' => 'col-sm-2 col-form-label']) !!}
                            <div class="col-sm-2">
                                <select name="bill[0][order_id]" id="1" data-id="order" class="form-control">
                                    <option value="" selected>Select Order Type</option>
                                    @foreach ($orders as $order)
                                        <option value="{{ $order->id }}">{{ $order->name }}</option>
                                    @endforeach
                                </select>
                            </div>



                            <!--Size-->
                            <div class="col-2 form-group row">
                                {!! Form::label('size_id', 'Size', ['class' => 'col-sm-3 col-form-label']) !!}
                                <div class="col-sm-9">
                                    <select name="bill[0][size_id]" id="size_id_1" data-id="1" data-class="size"
                                        class="form-control">
                                        <option value="" selected>Select a size</option>
                                    </select>
                                </div>
                            </div>
                            

                            <!--Rate-->
                            <div class="col-2 form-group row">
                                {!! Form::label('rate', 'Rate', ['class' => 'col-sm-3 col-form-label']) !!}
                                <div class="col-sm-9">
                                    <input type="number" name="bill[0][rate]" id="rate1" data-id="1" data-type="rate" class="form-control">
                                    @error('rate')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!--Quantity-->
                            <div class="col-2 form-group row">
                                {!! Form::label('quantity', 'Quantity', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    <input type="number" name="bill[0][quantity]" id="quantity1" data-id="1" data-type="quantity" value="1"
                                        class="form-control">
                                    @error('quantity')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>



                            <!--Total-->
                            <div class="col-2 form-group row">
                                {!! Form::label('total', 'Total', ['class' => 'col-sm-3 col-form-label']) !!}
                                <div class="col-sm-9">
                                    <input type="text" name="bill[0][total]" id="total1" value="" readonly
                                        class="form-control"> @error('rate')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="remove-order">
                                <i class="fas fa-times removeOrder d-none" data-orderId="order-1" data-order='1'></i>
                            </div>

                        </div>
                      


                       

                    </div>
                    <div class="row error-msg d-none">
                        <label for="" class="col-2"></label>
                        <span class="col-10 text text-danger" style="top: -10px">Please fill the
                            previous order details to add a new order. </span>

                    </div>
                @endif
                <div class="{{ isset($item) ? 'd-none' : '' }}">
                    <button type="button" class="btn btn-success btn-sm " id="btnAdd">Add</button>
                </div>

                {{-- Action --}}




                <!--Grand Total-->
                <div class="row">
                    <div class="col-4">
                        <div class="form-group row">
                            {!! Form::label('grand_total', 'Grand Total', ['class' => 'col-sm-6 col-form-label']) !!}
                            <div class="col-sm-6">
                                <td><input type="number" name="grand_total" value="{{ $item->grand_total ?? '0' }}"
                                        id="grand_total" class="form-control" readonly>
                                </td>
                            </div>
                        </div>
                    </div>

                    <!--Paid Amount-->
                    <div class="col-4">
                        <div class="form-group row">
                            {!! Form::label('paid_amount', 'Paid Amount', ['class' => 'col-sm-3 col-form-label']) !!}
                            <div class="col-sm-6">
                                <td><input type="number" name="paid_amount" value="{{ $item->paid_amount ?? '' }}"
                                        id="paid_amount" class="form-control" {{ isset($item) ? 'readonly' : '' }}>
                                </td>
                            </div>
                        </div>
                        @error('paid_amount')
                            <p class="text text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-4">
                        <!--Balance Amount-->
                        <div class="form-group row">
                            {!! Form::label('total', 'Balance Amount', ['class' => 'col-sm-4 col-form-label']) !!}
                            <div class="col-sm-6">
                                <td><input type="text" name="balance_amount" id="balance_amount"
                                        value="{{ $item->balance_amount ?? '' }}" readonly class="form-control"></td>
                            </div>
                        </div>
                    </div>
                </div>




                <!--Cash Received-->
                <div class="form-group row">
                    {!! Form::label('cash_received', 'Cash Received', ['class' => 'col-sm-2 col-form-label']) !!}
                    <div class="col-sm-10   ">
                        <td><input type="number" name="cash_received" value="{{ $item->cash_received ?? '' }}"
                                id="cash_received" class="form-control"></td>
                        @error('rate')
                            <span class="text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--Cash Return-->
                <div class="form-group row">
                    {!! Form::label('rate', 'Cash return', ['class' => 'col-sm-2 col-form-label']) !!}
                    <div class="col-sm-10">
                        <td><input type="text" name="cash_return" value="{{ $item->cash_return ?? '' }}"
                                id="cash_return" class="form-control" readonly></td>
                        @error('rate')
                            <span class="text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <!--Ordered Data-->
                        <div class="form-group row">
                            <label for="order_date" class="col-sm-4 col-form-label">Ordered Date</label>
                            <div class="col-sm-8">
                                <input type="text" value="{{ $item->ordered_date ?? '' }}" name="ordered_date"
                                    class="form-control" id="nepali-datepicker" {{ isset($item) ? 'readonly' : '' }}>
                            </div>
                        </div>

                    </div>
                    <div class="col-6">
                        <!--Delivery Date-->
                        <div class="form-group row">
                            <label for="texr" class="col-sm-4 col-form-label">Delivery Date</label>
                            <div class="col-sm-8">
                                <input type="text" name="delivery_date" value="{{ $item->delivery_date ?? '' }}"
                                    class="form-control" id="nepali-datepicker1" {{ isset($item) ? 'readonly' : '' }}>
                            </div>
                        </div>
                        @error('delivery_date')
                            <span class="text text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!--Prepared by-->
                    <div class="form-group row">
                        {!! Form::label('user_id', 'Prepare By', ['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                            <select name="" id="" class="form-control">
                                <option value="">Select your name</option>
                                <option value="">Raj Shrestha</option>
                                <option value="">Biraj Shrestha</option>
                                <option value="">Rajeev Shrestha</option>
                            </select>
                            @error('user_id')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <button class="btn btn-success">Submit</button>
                </div>
                {!! Form::close() !!}
            </div>

        </div>

    @endsection



    @section('js')
        @include('frontend.bill.include.script')
        {{-- For nepali date picker --}}
        <script src="{{ asset('nepalidatepicker/js/nepali.datepicker.v3.7.min.js') }}" type="text/javascript"></script>
        <script type="text/javascript">
            window.onload = function() {
                var mainInput = document.getElementById("nepali-datepicker");
                var mainInput1 = document.getElementById("nepali-datepicker1");
                mainInput.nepaliDatePicker();
                mainInput1.nepaliDatePicker();
            };
        </script>
    @endsection
