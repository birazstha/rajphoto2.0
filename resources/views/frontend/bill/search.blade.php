@section('main-content')
    <form class="d-flex" action="{{route('frontend.bill.search')}}">
        @csrf
        <input class="form-control me-2" type="search" name="id" id="id" placeholder="Scan Qr Code" aria-label="Search">
        {{--        <button class="btn btn-danger" type="submit"><i class="fas fa-search search-icon"></i></button>--}}

    </form>


    @if(!isset($data['row']))
        No bill found
 @elseif($data['row']->active === 0)
     <h3 style="text-align: center">This Bill was already scanned. Ordered was delivered in '{{$data['row']->updated_at}}'</h3>

    @else
     <div class="form">
        <div class="table">
            <div class="table-responsive">
            {{Form::open(['route' => $base_route.'deliveryBill','id'=>'cart'])}}
            <!--Name-->
                <div class="form-group row">

                    {!! Form::label('name','Name',['class'=>'col-sm-2 col-form-label']) !!}
                    <div class="col-sm-10">
                        <input type="text" name="name" value="{{$data['row']->name}}"  class="form-control" >

                        @error('name')
                        <span class="text text-danger">{{$message}}</span>
                        @enderror
                    </div>

                </div>


                <!--Order-->
                <div class="form-group row ">
                    {!! Form::label('order_id','Order',['class'=>'col-sm-2 col-form-label']) !!}
                    <div class="col-sm-10">
                        <select name="order_id"  class="form-control">
                            <option value="{{$data['row']->order_id}}" >{{$data['row']->order->name}}</option>
                        </select>
                        @error('order_id')
                        <p class="text text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>


                <!--Size-->
                <div class="form-group row">
                    {!! Form::label('size_id','Size',['class'=>'col-sm-2 col-form-label']) !!}
                    <div class="col-sm-10">
                        <select name="size_id"  class="form-control">
                            <option value="{{$data['row']->size_id}}" >{{$data['row']->size->name}}</option>
                        </select>
                         @error('size_id')
                        <span class="text text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <!--Quantity-->
                <div class="form-group row">
                    {!! Form::label('quantity','Quantity',['class'=>'col-sm-2 col-form-label']) !!}
                    <div class="col-sm-10">
                        <input type="text" name="quantity" value="{{$data['row']->quantity}}"  class="form-control" >

                    </div>
                </div>
                @error('quantity')
                <span class="text text-danger">{{$message}}</span>
                @enderror

            <!--Rate-->
                <div class="form-group row">
                    {!! Form::label('rate','Rate',['class'=>'col-sm-2 col-form-label']) !!}
                    <div class="col-sm-10">
                        <input type="text" name="rate" value="{{$data['row']->rate}}"  class="form-control" >

                        @error('rate')
                        <span class="text text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>


                <div class="row">
                    <div class="col-4">
                        <!--Net Total-->
                        <div class="form-group row">
                            {!! Form::label('total','Total',['class'=>'col-sm-6 col-form-label']) !!}
                            <div class="col-sm-6">
                                <td><input type="text" name="total" value="{{$data['row']->total}}"  class="form-control" ></td>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <!--Paid Amount-->
                        <div class="form-group row">
                            {!! Form::label('paid_amount','Paid Amount',['class'=>'col-sm-6 col-form-label']) !!}
                            <div class="col-sm-6">
                                <td><input type="number" name="paid_amount" value="{{$data['row']->paid_amount}}"  class="form-control" ></td>
                            </div>
                        </div>
                        @error('paid_amount')
                        <p class="text text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="col-4">
                        <!--Balance Amount-->
                        <div class="form-group row">
                            {!! Form::label('total','Balance Amount',['class'=>'col-sm-6 col-form-label']) !!}
                            <div class="col-sm-6">
                                <td><input type="text" name="balance_amount" value="{{$data['row']->balance_amount}}" class="form-control"></td>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <!--Rate-->


                    <div class="form-group row">

                        {!! Form::label('cash_received','Cash Received',['class'=>'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">

                            <td><input type="number" name="cash_received" class="form-control" ></td>
                            @error('cash_received')
                            <span class="text text-danger">{{$message}}</span>
                            @enderror
                        </div>


                        {!! Form::label('rate','Cash Returned',['class'=>'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">

                            <td><input type="number" name="cash_return" value="" jAutoCalc="{cash_received} - {balance_amount}"  class="form-control" ></td>
                            @error('rate')
                            <span class="text text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <input type="hidden" name="bill_id" value="{{$data['row']->id}}">

                    </div>

                    <button class="btn btn-success">Clear Bill</button>

                </div>
                {!! Form::close() !!}
                {{--            </form>--}}


                <form action="">

                </form>





            </div>

        </div>
    </div>
    @endif
@endsection

@section('js')
    @include($base_route.'include.script')
@endsection

@include('frontend.layout.master')



