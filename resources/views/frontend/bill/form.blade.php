@section('main-content')
    <div class="form">
        <div class="table">
            <div class="table-responsive">
                {{Form::open(['route' => 'bill.store'])}}
                <!--Name-->
                <div class="form-group row">

                    {!! Form::label('name', 'Name', ['class' => 'col-sm-1 col-form-label']) !!}
                    <div class="col-sm-11">
                        {!! Form::text('name', null, ['class' => 'form-control','required', 'placeholder' => "Enter customer's name"]) !!}
                        @error('name')
                            <span class="text text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>


                <div class="dynamic-input">
                    <div class="row">
                        <!--Order-->
                        <div class="col-2 form-group row ">
                            {!! Form::label('order_id', 'Order', ['class' => 'col-sm-4 col-form-label']) !!}
                            <div class="col-sm-8">

                                <select name="order_id[]" id="order_id_1" class="form-control">
                                    <option value="" selected>Select Order Type</option>
                                    @foreach ($orders as $order)
                                        <option value="{{ $order->id }}">{{ $order->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!--Size-->
                        <div class="col-2 form-group row">
                            {!! Form::label('size_id', 'Size', ['class' => 'col-sm-3 col-form-label']) !!}
                            <div class="col-sm-9">
                                <select name="size_id[]" id="size_id_1" class="form-control">
                                    <option value="" selected>Select a size</option>
                                </select>
                            </div>
                        </div>

                        <!--Rate-->
                        <div class="col-2 form-group row">
                            {!! Form::label('rate', 'Rate', ['class' => 'col-sm-3 col-form-label']) !!}
                            <div class="col-sm-9">
                                <input type="number" name="rate[]" id="rate" class="form-control">
                                @error('rate')
                                    <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <!--Quantity-->
                        <div class="col-2 form-group row">
                            {!! Form::label('quantity', 'Quantity', ['class' => 'col-sm-3 col-form-label']) !!}
                            <div class="col-sm-9">
                                <input type="number" name="quantity[]" id="quantity" value="1" class="form-control">
                            
                            </div>
                        </div>
                        @error('quantity')
                            <span class="text text-danger">{{ $message }}</span>
                        @enderror

                        

                        <!--Total-->
                        <div class="col-2 form-group row">
                            {!! Form::label('total', 'Total', ['class' => 'col-sm-3 col-form-label']) !!}
                            <div class="col-sm-9">
                                <input type="text" name="total[]" id="total" value="" readonly 
                                    class="form-control"> @error('rate')
                                    <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    {{-- For cloning --}}
                    <div class="more-inputs"></div>
                </div>


                {{-- Action --}}
                <div>
                    <div>
                        <button type="button" class="btn btn-success btn-sm " id="btnAdd" >Add</button>
                        <button type="button" class="btn btn-danger btn-sm">Remove</button>
                    </div>

                    <!--Grand Total-->
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group row">
                                {!! Form::label('grand_total', 'Grand Total', ['class' => 'col-sm-6 col-form-label']) !!}
                                <div class="col-sm-6">
                                    <td><input type="number" name="grand_total" value="" id="grand_total" 
                                             class="form-control"></td>
                                </div>
                            </div>
                        </div>

                        <!--Paid Amount-->
                        <div class="col-4">
                            <div class="form-group row">
                                {!! Form::label('paid_amount', 'Paid Amount', ['class' => 'col-sm-6 col-form-label']) !!}
                                <div class="col-sm-6">
                                      <td><input type="number" name="paid_amount" value="" id="paid_amount" 
                                        class="form-control"></td>
                                </div>
                            </div>
                            @error('paid_amount')
                                <p class="text text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-4">
                            <!--Balance Amount-->
                            <div class="form-group row">
                                {!! Form::label('total', 'Balance Amount', ['class' => 'col-sm-6 col-form-label']) !!}
                                <div class="col-sm-6">
                                    <td><input type="text" name="balance_amount" id ="balance_amount" readonly
                                            class="form-control"></td>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Cash Received-->
                    <div class="form-group row">
                        {!! Form::label('rate', 'Cash Received', ['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                            <td><input type="number" name="cash_received" value="" id="cash_received" class="form-control"></td>
                            @error('rate')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!--Cash Return-->
                    <div class="form-group row">
                        {!! Form::label('rate', 'Cash return', ['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                            <td><input type="text" name="cash_return" value="" id="cash_return" class="form-control" readonly></td>

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
                                    <input type="text" value=""
                                        name="ordered_date" class="form-control" id="nepali-datepicker">
                                </div>
                            </div>

                        </div>
                        <div class="col-6">
                            <!--Delivery Date-->
                            <div class="form-group row">
                                <label for="texr" class="col-sm-4 col-form-label">Delivery Date</label>
                                <div class="col-sm-8">
                                    <input type="text" name="delivery_date"
                                        value="" class="form-control"
                                        id="nepali-datepicker1">
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
                                {!! Form::select('user_id', [], null, ['class' => 'form-control', 'placeholder' => 'Select your name']) !!}
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

    @include('frontend.layout.master')
