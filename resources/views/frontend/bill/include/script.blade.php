<script>
    $(document).ready(function() {
        let count = 1;
        function init(){
            count++;
        }

        $('.dynamic-input').delegate('select[id=order_id_1]', 'change', function () {
            var order = $(this).val();
            var path = "{{ URL::route('order.getSize') }}";
            $.ajax({
                url: path,
                data: {
                    'order_id': order,
                    '_token': "{{ csrf_token() }}"
                },
                method: 'post',
                dataType: 'text',
                success: function(response) {
                    $('#size_id_1').empty();
                    $('#size_id_1').append(response);
                }
            });
        });

        $('.dynamic-input').delegate('select[id=order_id_2]', 'change', function () {
            var order = $(this).val();
            var path = "{{ URL::route('order.getSize') }}";
            $.ajax({
                url: path,
                data: {
                    'order_id': order,
                    '_token': "{{ csrf_token() }}"
                },
                method: 'post',
                dataType: 'text',
                success: function(response) {
                    $('#size_id_2').empty();
                    $('#size_id_2').append(response);
                }
            });
        });

 
    //Triggered when button clicked   
    $('#btnAdd').click(function(e) {
    init();
    e.preventDefault();
    let template =`<div class="row">
                        <!--Order-->
                        <div class="col-2 form-group row ">
                            {!! Form::label('order_id', 'Order', ['class' => 'col-sm-4 col-form-label']) !!}
                            <div class="col-sm-8">

                                <select name="order_id" id="order_id_${count}" class="form-control">
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
                                <select name="size_id" id="size_id_${count}" class="form-control">
                                    <option value="" selected>Select a size</option>
                                </select>
                            </div>
                        </div>

                        <!--Quantity-->
                        <div class="col-2 form-group row">
                            {!! Form::label('quantity', 'Quantity', ['class' => 'col-sm-3 col-form-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::number('quantity', 1, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        @error('quantity')
                            <span class="text text-danger">{{ $message }}</span>
                        @enderror

                        <!--Rate-->
                        <div class="col-2 form-group row">
                            {!! Form::label('rate', 'Rate', ['class' => 'col-sm-3 col-form-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::number('rate', null, ['class' => 'form-control']) !!}
                                @error('rate')
                                    <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <!--Total-->
                        <div class="col-2 form-group row">
                            {!! Form::label('rate', 'Total', ['class' => 'col-sm-3 col-form-label']) !!}
                            <div class="col-sm-9">
                                <input type="text" name="item_total" value="" jAutoCalc="{quantity} * {rate}"
                                class="form-control">   @error('rate')
                                    <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>`;

                $('.more-inputs').append(template);
            });
        });


        //Calculation

 
        var rate = null;
       var quantity = 1;
        $('#rate').keyup(function() {
            rate = $(this).val();
            console.log(rate);
            calculate();
        });

        $('#quantity').on('change keyup',function() {
            quantity = $(this).val();
            calculate();
    
        });

        function calculate(){
           let total = rate*quantity;
            $('#total').val(total);
        }

       
    

</script>
