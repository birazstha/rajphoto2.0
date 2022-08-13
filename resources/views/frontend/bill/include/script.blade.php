<script>
    $(document).ready(function() {
        let count = 1;

        function init() {
            count++;
        }

        //First order
        $('.dynamic-input').delegate('select[id=order_id_1]', 'change', function() {
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
                    $('#rate').val('');
                    $('#quantity').val('');
                    $('#total').val('');
                    $('#size_id_1').append(response);
                   
                }
            });
        });

        //Second order
        $('.dynamic-input').delegate('select[id=order_id_2]', 'change', function() {
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
                    $('#rate2').val('');
                    $('#quantity2').val('');
                    $('#total2').val('');
                    $('#size_id_2').append(response);
                }
            });
        });


        //Append new order 
        $('#btnAdd').click(function(e) {
            init();
            e.preventDefault();
            let template = ` <div class="row">
                        <!--Order-->
                        <div class="col-2 form-group row ">
                            {!! Form::label('order_id', 'Order', ['class' => 'col-sm-4 col-form-label']) !!}
                            <div class="col-sm-8">

                                <select name="order_id[]" id="order_id_${count}" class="form-control">
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
                                <select name="size_id[]" id="size_id_${count}" class="form-control">
                                    <option value="" selected>Select a size</option>
                                </select>
                            </div>
                        </div>

                        <!--Rate-->
                        <div class="col-2 form-group row">
                            {!! Form::label('rate', 'Rate', ['class' => 'col-sm-3 col-form-label']) !!}
                            <div class="col-sm-9">
                                <input type="number" name="rate[]" id="rate${count}" class="form-control">
                                @error('rate')
                                    <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <!--Quantity-->
                        <div class="col-2 form-group row">
                            {!! Form::label('quantity', 'Quantity', ['class' => 'col-sm-3 col-form-label']) !!}
                            <div class="col-sm-9">
                                <input type="number" name="quantity[]" id="quantity${count}" value="1" class="form-control">
                            
                            </div>
                        </div>
                        @error('quantity')
                            <span class="text text-danger">{{ $message }}</span>
                        @enderror


                        <!--Total-->
                        <div class="col-2 form-group row">
                            {!! Form::label('total', 'Total', ['class' => 'col-sm-3 col-form-label']) !!}
                            <div class="col-sm-9">
                                <input type="text" name="total[]" id="total${count}" value="" readonly 
                                    class="form-control"> @error('rate')
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


    //First order
    $('.dynamic-input').delegate('input[id=rate]', 'change keyup', function() {
        rate = $(this).val();
        let total = rate * quantity;
        $('#total').val(total);
        calculateGrandTotal();
    });

    $('.dynamic-input').delegate('input[id=quantity]', 'change keyup', function() {
        quantity = $(this).val();
        let total = rate * quantity;
        $('#total').val(total);
        calculateGrandTotal();
    });


    //Second order
    $('.dynamic-input').delegate('input[id=rate2]', 'change keyup', function() {
      
        rate = $(this).val();
        let total = rate * quantity;
        $('#total2').val(total);
        calculateGrandTotal();
    });
    
    $('.dynamic-input').delegate('input[id=quantity2]', 'change keyup', function() {
        quantity = $(this).val();
        let total = rate * quantity;
        $('#total2').val(total);
        calculateGrandTotal();
        
    });

    //Calculating grand total

    let grand_total = 0;
    function calculateGrandTotal(){
        let total = parseInt($('#total').val());
        let total2 = parseInt($('#total2').val());

        //if total2 is not added
        if(!total2){
            grand_total = total + 0;
        }else{
            grand_total = total + total2;
        }

        $('#grand_total').val(grand_total);
    }

    $('#grand_total').change(function(){
        alert('hello');
    });

    //Calculate balance amount
    let balanceAmt = 0;
    $('#paid_amount').on('keyup change',function(){
             balanceAmt = grand_total - $('#paid_amount').val();
            $('#balance_amount').val(balanceAmt);
    });

     //Calculate cash return
     $('#cash_received').on('keyup change',function(){
             cashReturn = $('#cash_received').val() - $("#paid_amount").val();
            $('#cash_return').val(cashReturn);
    });

   

     


</script>
