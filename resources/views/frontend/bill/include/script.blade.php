<script>
    $(document).ready(function() {
        var count = 1;

        function init() {
            count++;
        }
        $(document).on('change', 'select[data-id=order]', function() {
            let sizedId = '#size_id_' + $(this).attr('id');
            let rateId = '#rate' + $(this).attr('id');
            let quantityId = '#quantity' + $(this).attr('id');
            let totalId = '#total' + $(this).attr('id');
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
                    $(sizedId).empty();
                    $(rateId).val('');
                    $(quantityId).val('1');
                    $(totalId).val('');
                    $(sizedId).append(response);

                }
            });
        });

        $(document).on('change', 'select[data-class=size]', function() {
            var size = $(this).val();
            let rateId = '#rate' + $(this).attr('data-id');
            let totalId = '#total' + $(this).attr('data-id');
            let lastTotalId = $(this).attr('data-id') - 1;
            let lastTotalValue = $(`#${lastTotalId}`).val();
            let quantityId = '#quantity' + $(this).attr('data-id');
            let quantityData = $(`${quantityId}`).val();

            var path = "{{ URL::route('size.getRate') }}";
            $.ajax({
                url: path,
                data: {
                    'size_id': size,
                    '_token': "{{ csrf_token() }}"
                },
                method: 'post',
                dataType: 'text',
                success: function(response) {
                    $(rateId).val(response);

                    //Calculate total price automatically when size appears
                    let data = response * parseInt(quantityData);
                    $(`${totalId}`).val(data);
                    $('.error-msg').addClass('d-none');

                    //Calculating grand total when the size's rate appears
                    var grandTotal = 0;
                    for (let i = 1; i <= count; i++) {
                        let finalTotal = $(`#total${i}`).val();
                        grandTotal = parseInt(finalTotal) + parseInt(grandTotal);
                    }

                    $('#grand_total').  val(grandTotal);

                },
            });
        });



        //Append new order 
        $('#btnAdd').click(function() {
            
            // Check if user has entered full order details or not
            let currentTotal = $(`#total${count}`).val();
            if(!currentTotal){
                $('.error-msg').removeClass('d-none');
                return false;
            }
            $('.removeOrder').removeClass('d-none');
            //Increase the count
            init();
            var template = `<div class="appended row" id=order-${count}>
                            <!--Order-->
                     
                                {!! Form::label('order_id', 'Order', ['class' => 'col-sm-2 col-form-label']) !!}
                                <div class="col-sm-2">
                                    <select name="order_id[]" id="${count}" data-id="order" class="form-control">
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
                                    <select name="size_id[]" id="size_id_${count}" data-id="${count}" data-class="size" class="form-control">
                                        <option value="" selected>Select a size</option>
                                    </select>
                                </div>
                            </div>

                            <!--Rate-->
                            <div class="col-2 form-group row">
                                {!! Form::label('rate', 'Rate', ['class' => 'col-sm-3 col-form-label']) !!}
                                <div class="col-sm-9">
                                    <input type="number" name="rate[]" id="rate${count}" data-id="${count}" class="form-control">
                                    @error('rate')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                               <!--Quantity-->
                               <div class="col-2 form-group row">
                                {!! Form::label('quantity', 'Quantity', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    <input type="number" name="quantity[]" id="quantity${count}" data-id="${count}" value="1" class="form-control">
                                    @error('quantity')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>



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
                            <div class="remove-order">
                                <i class="fas fa-times removeOrder" data-orderId="order-${count}" data-order='${count}'></i>
                            </div>


                            

                        </div>`;

            $('.more-inputs').append(template);
        });




        //Calculation
        var rate = null;
        var quantity = 1;
        $(document).delegate('input', 'change keyup', function() {
            totalId = '#total' + $(this).attr('data-id');
            quantityId = '#quantity' + $(this).attr('data-id');
            quantityValue = $(`${quantityId}`).val();
            rateId = '#rate' + $(this).attr('data-id');
            rateValue = $(`${rateId}`).val();
            checkInputType = $(this).attr('name');

            //Poputlating total according to rate appeared
            if (checkInputType === 'rate[]') {
                rate = $(this).val();
                total = rate * parseInt(quantityValue);
                $(totalId).val(total);

            } //Poputlating total according to quality
            else {
                quantity = $(this).val();
                total1 = quantity * parseInt(rateValue);
                $(totalId).val(total1);
            }

            //Calculate grand total
            var grand_total = 0;
            for (let i = 1; i <= count; i++) {
                let total = $(`#total${i}`).val();
                grand_total = parseInt(total) + parseInt(grand_total);
            }
            $('#grand_total').val(grand_total);

        });


        //Calculate balance amount
        let balanceAmt = 0;
        $('#paid_amount').on('keyup change', function() {
            balanceAmt = $('#grand_total').val() - $(this).val();
            $('#balance_amount').val(balanceAmt);
        });

        //Calculate cash return
        $('#cash_received').on('keyup change', function() {
            cashReturn = $('#cash_received').val() - $("#paid_amount").val();
            $('#cash_return').val(cashReturn);
        });

        


        //For removing specific order
        $(document).on('click','.removeOrder',function(){
                       
            //set current total
            let currentTotal = $(`#total${count}`).val();
      
            //Deducting the amount of deleted order
            let totalAmountId = $(this).data('order');
            let currentTotalAmount = $(`#total${totalAmountId}`).val();
            let currentGrandTotal = $('#grand_total').val();
            let newGrandTotal = currentGrandTotal - currentTotalAmount;
           $('#grand_total').val(newGrandTotal);


           let orderId = $(this).data('orderid');
            if (count != 1) {
                count--;
            }
            $(`#${orderId}`).remove();

            //If only one order is left then remove the remove icon.
            let countOrder = $('.removeOrder').length
            if(countOrder===1){
               $('.removeOrder').addClass('d-none'); 
            }
    
        });

       
    });

    

</script>
