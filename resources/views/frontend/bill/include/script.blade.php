<script>
    $(document).ready(function() {
        var count = 1;
        var currentTotal;
        var balanceAmt = 0;
        var lastTotal;
        var currentGrandTotal =  parseInt($('#grand_total').val());
        function setLastTotal(data){
            lastTotal = data;
        }
        function init() {
            count++;
        }
        $(document).on('change', 'select[data-id=order]', function() {
            let sizedId = '#size_id_' + $(this).attr('id');
            let rateId = '#rate' + $(this).attr('id');
            let quantityId = '#quantity' + $(this).attr('id');
            let totalId = '#total' + $(this).attr('id');
            var order = $(this).val();
            var currentGrandTotal =  parseInt($('#grand_total').val());
            let currentTotalAmount=  $(totalId).val();

            if(currentGrandTotal){
                var grandTotal = currentGrandTotal - currentTotalAmount;
                $('#grand_total').val(grandTotal);
            }
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

        function calculateGrandTotal(response,oldTotalAmount){
                    if(currentGrandTotal==0){
                        $('#grand_total').val(response);
                       }else{
                        var currentGrandTotal =  parseInt($('#grand_total').val());
                        if(!oldTotalAmount){
                            var gradTotal = currentGrandTotal + parseInt(response);
                            $('#grand_total').val(gradTotal);
                        }else{
                            var gradTotal = currentGrandTotal - parseInt(oldTotalAmount) + parseInt(response);
                        }
                       $('#grand_total').val(gradTotal);
                    }
        }

        function setOldAmountData(){
            //
        }

        $(document).on('change', 'select[data-class=size]', function() {
            var size = $(this).val();
            let rateId = '#rate' + $(this).attr('data-id');
            let totalId = '#total' + $(this).attr('data-id');
            let lastTotalId = $(this).attr('data-id') - 1;
            let lastTotalValue = $(`#${lastTotalId}`).val();
            let quantityId = '#quantity' + $(this).attr('data-id');
            let quantityData = $(`${quantityId}`).val();
            let oldTotalAmount = $(totalId).val(); 
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
                    //setting the rate of the selected Size
                    $(rateId).val(response);
                    //Calculate total price automatically when size appears
                    let totalAmount = response * parseInt(quantityData);
                    $(`${totalId}`).val(totalAmount);
                    //Calculating grand total when the size's rate appears
                    calculateGrandTotal(response,oldTotalAmount);
                },
            });
        });


      
        //Append new order 
        $('#btnAdd').click(function() {
           
            // Check if user has entered full order details or not
            // currentTotal = $(`#total${count}`).val();
            // setLastTotal(currentTotal);
            // if(!lastTotal){
            //     $('.error-msg').removeClass('d-none');
            //     return false;
            // }
            
            $('.removeOrder').removeClass('d-none');
            //Increase the count
            init();
            var template = `<div class="row" id=order-${count}>
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
                                    <input type="number" name="rate[]" id="rate${count}" data-id="${count}" data-type="rate" class="form-control">
                                    @error('rate')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                               <!--Quantity-->
                               <div class="col-2 form-group row">
                                {!! Form::label('quantity', 'Quantity', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    <input type="number" name="quantity[]" id="quantity${count}" data-id="${count}" data-type="quantity" value="1" class="form-control">
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

            $('.dynamic-input').append(template);
        });

        
        //For removing specific order
        $(document).on('click','.removeOrder',function(){
            //Deducting the amount of deleted order
            let totalAmountId = $(this).data('order');
            let currentTotalAmount = $(`#total${totalAmountId}`).val();
            let currentGrandTotal = $('#grand_total').val();
            let newGrandTotal = currentGrandTotal - currentTotalAmount;
           $('#grand_total').val(newGrandTotal);


           let orderId = $(this).data('orderid');
            //set a new currentTotal
            previousTotal = $(`#order-${totalAmountId}`).prev().find('input[name="total[]"]').val();
            setLastTotal(previousTotal);
            //if current total has data than allow user to add new
            
            $(`#${orderId}`).remove();

            //If only one order is left then remove the remove icon.
            let countOrder = $('.removeOrder').length
            if(countOrder===1){
               $('.removeOrder').addClass('d-none'); 
            }
    
        });


        //Calculation
        var rate = null;
        var quantity = 1;
        $(document).on('change keyup','input[data-type=rate],input[data-type=quantity]', function() {
            totalId = '#total' + $(this).attr('data-id');
            quantityId = '#quantity' + $(this).attr('data-id');
            quantityValue = $(`${quantityId}`).val();
            rateId = '#rate' + $(this).attr('data-id');
            rateValue = $(`${rateId}`).val();
            checkInputType = $(this).attr('name');
            let oldTotalAmount = $(totalId).val(); 

            //Poputlating total according to rate appeared
            if (checkInputType === 'rate[]') {
                rate = $(this).val();
              total = rate * parseInt(quantityValue);
                $(totalId).val(total);
                calculateGrandTotal(total,oldTotalAmount);
            } //Poputlating total according to quantity
            else {
                quantity = $(this).val();
                total1 = quantity * parseInt(rateValue);
                $(totalId).val(total1)
                calculateGrandTotal(total1,oldTotalAmount);
            }

            //Calculate grand total
         

        });


        //Calculate balance amount
       
        $('#paid_amount').on('keyup change', function() {
            balanceAmt = $('#grand_total').val() - $(this).val();
            $('#balance_amount').val(balanceAmt);
        });

        //Calculate cash return
        $('#cash_received').on('keyup change', function() {
            cashReturn = $('#cash_received').val() - $("#paid_amount").val();
            $('#cash_return').val(cashReturn);
        });

        


       
    });

    

</script>
