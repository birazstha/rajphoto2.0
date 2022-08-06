@section('main-content')


    <div class="form">
    <div class="table">
        <div class="table-responsive">
            {{Form::open(['route' => $base_route.'otherBill','id'=>'cart'])}}
            <!--Order-->
                <div class="form-group row ">
                    {!! Form::label('order_id','Order',['class'=>'col-sm-2 col-form-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::select('order_id',$data['orders'],null,['class'=>'form-control','placeholder'=>'Select a order']) !!}
                        @error('order_id')
                        <p class="text text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>

                <!--Quantity-->
                <div class="form-group row">
                    {!! Form::label('quantity','Quantity',['class'=>'col-sm-2 col-form-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::number('quantity',1,['class'=>'form-control']) !!}
                    </div>
                </div>
                @error('quantity')
                <span class="text text-danger">{{$message}}</span>
                @enderror

                <!--Rate-->
                <div class="form-group row">
                    {!! Form::label('rate','Rate',['class'=>'col-sm-2 col-form-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::number('rate',null,['class'=>'form-control']) !!}
                        @error('rate')
                        <span class="text text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

            <!--Total-->
                <div class="form-group row">
                    {!! Form::label('total','Total',['class'=>'col-sm-2 col-form-label']) !!}
                    <div class="col-sm-10">

                        <td><input type="text" name="total" value="" jAutoCalc="{quantity} * {rate}" class="form-control"></td>
                    </div>
                </div>
                @error('total')
                <span class="text text-danger">{{$message}}</span>
            @enderror

            <!--Cash Received-->
                <div class="form-group row">
                    {!! Form::label('cash_received','Cash Received',['class'=>'col-sm-2 col-form-label']) !!}
                    <div class="col-sm-10">

                        <td><input type="text" name="cash_received" value="" class="form-control"></td>
                    </div>
                </div>
                @error('total')
                <span class="text text-danger">{{$message}}</span>
                @enderror

            <!--Cash Returned-->
                <div class="form-group row">
                    {!! Form::label('cash_return','Cash Returned',['class'=>'col-sm-2 col-form-label']) !!}
                    <div class="col-sm-10">

                        <td><input type="number" name="cash_return" value="" jAutoCalc="{cash_received} - {total}" class="form-control"></td>
                    </div>
                </div>
                @error('total')
                <span class="text text-danger">{{$message}}</span>
                @enderror



                <button class="btn btn-success">Submit</button>


                {!! Form::close() !!}
{{--            </form>--}}







        </div>

    </div>
    </div>
@endsection

@section('js')
    @include($base_route.'include.script')
@endsection

@include('frontend.layout.master')


