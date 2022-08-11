<script>




    $(document).ready(function() {

        
        var count = 1;
        function init(){
           count = count+1;
        }

        // Triggered when changed
        $('#order_id_1').on('change',function() {
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
                    $('#size_id').empty();
                    $('#size_id').append(response);
                }
            });
        });

   

    
    //Triggered when button clicked   
    $('#btnAdd').click(function(e) {
     
        init();
                e.preventDefault();
                let template =`  <div class="row">
                        <!--Order-->
                        <div class="col-3 form-group row ">
                            {!! Form::label('order_id', 'Order', ['class' => 'col-sm-4 col-form-label']) !!}
                            <div class="col-sm-8">
                                <select name="order_id" id="order_id_${count}" class="form-control">
                                    <option value="" selected>Select order</option>
                                    @foreach ($orders as $order )
                                    <option value="{{ $order->id }}">{{ $order->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!--Size-->
                        <div class="col-3 form-group row">
                            {!! Form::label('size_id', 'Size', ['class' => 'col-sm-3 col-form-label']) !!}
                            <div class="col-sm-9">
                                <select name="size_id" id="size_id" class="form-control">
                                    <option value="" selected>Select order</option>
                                </select>
                            </div>
                        </div>

                        <!--Quantity-->
                        <div class="col-3 form-group row">
                            {!! Form::label('quantity', 'Quantity', ['class' => 'col-sm-3 col-form-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::number('quantity', 1, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        @error('quantity')
                            <span class="text text-danger">{{ $message }}</span>
                        @enderror

                        <!--Rate-->
                        <div class="col-3 form-group row">
                            {!! Form::label('rate', 'Rate', ['class' => 'col-sm-3 col-form-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::number('rate', null, ['class' => 'form-control']) !!}
                                @error('rate')
                                    <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>`;

                $('.dynamic-input').append(template);
            });
        });
</script>