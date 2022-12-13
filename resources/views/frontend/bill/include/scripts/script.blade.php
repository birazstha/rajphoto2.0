<script>
    $(document).ready(function() {
        var count = 1;
        var balanceAmt = 0;
        var lastTotal;
        var billCount = 0;
        var grandTotal;
        var totalAmount;
        var currentGrandTotal = parseInt($('#grand_total').val());
        var oldTotalAmount;

        function setLastTotal(data) {
            lastTotal = data;
        }

        function init() {
            count++;
        }

        function calculateGrandTotal(response, oldTotalAmount) {
         
            if (currentGrandTotal == 0) {
                $('#grand_total').val(response);
            } else {
                var currentGrandTotal = parseInt($('#grand_total').val());
                if (!oldTotalAmount) {
                  grandTotal = currentGrandTotal + parseInt(response);
                    $('#grand_total').val(grandTotal);
                } else {
                    grandTotal = currentGrandTotal - parseInt(oldTotalAmount) + parseInt(response);
                }
                $('#grand_total').val(grandTotal);
            }
        }
        $(document).on('change', 'select[data-id=order]', function() {
           
            let sizedId = '#size_id_' + $(this).attr('id');
            let rateId = '#rate' + $(this).attr('id');
            let quantityId = '#quantity' + $(this).attr('id');
            let totalId = '#total' + $(this).attr('id');
            let totalValue = $(totalId).val();
            var currentGrandTotal = parseInt($('#grand_total').val());
            $('#grand_total').val(currentGrandTotal - totalValue);
            var orderId = $(this).val();
            let OrderName = $("select[data-id=order] option:selected").text();
            if(OrderName === 'Other'){
                $('#size_id_1').attr('disabled','true');
                $('#rate1').attr('disabled','true');
                $('#quantity1').attr('disabled','true');
                $('#btnAdd').addClass('d-none');
                $('.toggle-other-title').removeClass('d-none');
                $('#grand_total').removeAttr('readonly');
            }else{  
                $('#size_id_1').removeAttr('disabled');
                $('#rate1').removeAttr('disabled');
                $('#quantity1').removeAttr('disabled');
                $('#btnAdd').removeClass('d-none');
                $('.toggle-other-title').addClass('d-none');
                $('#grand_total').attr('readonly','true');


            }

            var path = "{{ URL::route('order.getSize') }}";
            $.ajax({
                url: path,
                data: {
                    'order_id': orderId,
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

        $(document).on('change', 'select[data-class=size]', ($.debounce(200,function() {
            var size = $(this).val();
            let rateId = '#rate' + $(this).attr('data-id');
            let totalId = '#total' + $(this).attr('data-id');
            let totalAmount = $(totalId).val();
            let lastTotalId = $(this).attr('data-id') - 1;
            let lastTotalValue = $(`#${lastTotalId}`).val();
            let quantityId = '#quantity' + $(this).attr('data-id');
            let quantityData = $(`${quantityId}`).val();
            $(`${quantityId}`).val('1');
           
           
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

                    //If total amount is already calculated and now changed,reset the total value
                    if(totalAmount){
                     $(`${totalId}`).val(response);
                    }else{
                        totalAmount = response * parseInt(quantityData);
                      $(`${totalId}`).val(totalAmount);
                    }
                    //Calculating grand total when the size's rate appears
                    calculateGrandTotal(response, oldTotalAmount);
                },
            });
        })));


           //Append new order 
           $('#btnAdd').click(function() {
            billCount++;
           
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
                                    <select name="bill[${billCount}][order_id]" id="${count}" data-id="order" class="form-control" required>
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
                                    <select name="bill[${billCount}][size_id]" id="size_id_${count}" data-id="${count}" data-class="size" class="form-control" required>
                                        <option value="" selected>Select a size</option>
                                    </select>
                                </div>
                            </div>

                            <!--Rate-->
                            <div class="col-2 form-group row">
                                {!! Form::label('rate', 'Rate', ['class' => 'col-sm-3 col-form-label']) !!}
                                <div class="col-sm-9">
                                    <input type="number" name="bill[${billCount}][rate]" id="rate${count}" data-id="${count}" data-type="rate" class="form-control" required>
                                    @error('rate')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                               <!--Quantity-->
                               <div class="col-2 form-group row">
                                {!! Form::label('quantity', 'Quantity', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    <input type="number" name="bill[${billCount}][quantity]" id="quantity${count}" data-id="${count}" data-type="quantity" value="1" class="form-control" required>
                                    @error('quantity')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!--Total-->
                            <div class="col-2 form-group row">
                                {!! Form::label('total', 'Total', ['class' => 'col-sm-3 col-form-label']) !!}
                                <div class="col-sm-9">
                                    <input type="text" name="bill[${billCount}][total]" id="total${count}" value="" readonly
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
        $(document).on('click', '.removeOrder', function() {
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
            if (countOrder === 1) {
                $('.removeOrder').addClass('d-none');
            }

        });


        //Calculation
        var rate = null;
        var quantity = 1;
        $(document).on('change keyup', 'input[data-type=rate],input[data-type=quantity]', function() {
            totalId = '#total' + $(this).attr('data-id');
            sizeId = '#size_id_' + $(this).attr('data-id');
            quantityId = '#quantity' + $(this).attr('data-id');
            quantityValue = $(`${quantityId}`).val();
            rateId = '#rate' + $(this).attr('data-id');
            rateValue = $(`${rateId}`).val();
            //Getting the size information
            sizeValue = $(`${sizeId}`).find(":selected").text();
            checkInputType = $(this).data('type');
            oldTotalAmount = $(totalId).val();

            //Poputlating total according to rate appeared
            if (checkInputType === 'rate') {
                rate = $(this).val();
                total = rate * parseInt(quantityValue);
                $(totalId).val(total);
                calculateGrandTotal(total, oldTotalAmount);
            } //Poputlating total according to quantity
            else {
                quantity = $(this).val();
                if (sizeValue === 'PP' || sizeValue === 'MRP'  && quantity>1) {
                    total1 = (parseInt(rateValue) + quantity * 100) - 100
                } else {
                    total1 = quantity * parseInt(rateValue);
                }
                $(totalId).val(total1)
                calculateGrandTotal(total1, oldTotalAmount);
            }
        });


        //Calculate balance amount
        $('#paid_amount').on('keyup change', function() {
            balanceAmt = $('#grand_total').val() - $(this).val();
            grandTotal = $('#grand_total').val();
            
            $('#due_amount').val(balanceAmt);
           

            var paidAmt = $(this).val();

            $('#cash_received').val(paidAmt);

            if(parseInt(paidAmt) > parseInt(grandTotal)  ){
                $('#error-paid-amount').text("Paid amount can't be greater than grand total");
            }else{
                $('#error-paid-amount').text('');
            }


            if(paidAmt == 0){
                $('#toggle-payment-method').addClass('d-none');
                $('#cash_received').val(0);

            }else{
                $('#toggle-payment-method').removeClass('d-none');
                $('#cash-transaction').removeClass('d-none');
            }

        });

        //Calculate cash return
        $('#cash_received').on('keyup change', function() {
            cashReturn = $('#cash_received').val() - $("#paid_amount").val();
            $('#cash_return').val(cashReturn);
        });

        //Phone Number Validation
        $(document).on('keyup','#phone_number',function(){
           var phoneNumber= $(this).val();
           if(phoneNumber.length > 10 ){
                $('#error-phone').text('Phone Number should not be greater than 10 digits.');
           }else{
            $('#error-phone').text('');
           }
        })

        $(document).on('blur','#phone_number',function(){
           var phoneNumber= $(this).val();
           if(phoneNumber.length < 10 ){
                $('#error-phone').text('Phone Number must be of 10 digits.');
           }else{
            $('#error-phone').text('');
           }
        })

    });
</script>

