<script>
    $(document).ready(function() {
<<<<<<< HEAD
        $("#order_id").on('change',function() {

=======
        var count = 1;
        function init(){
           count = count+1;
        }

        $(".dynamic-input1").on('change','select',function() {
>>>>>>> 056d438f8dd74b2d5f5eec06b60f96ecd6fba377

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
<<<<<<< HEAD
    });


//For cloning       
    $('#btnAdd').click(function(e) {
                e.preventDefault();

                let template =`  <div class="row">
=======

 
    //Triggered when button clicked   
    $('#btnAdd').click(function(e) {

                e.preventDefault();
                let template =` <div class="dynamic-input2">
                    <div class="row">
>>>>>>> 056d438f8dd74b2d5f5eec06b60f96ecd6fba377
                        <!--Order-->
                        <div class="col-3 form-group row ">
                            {!! Form::label('order_id', 'Order', ['class' => 'col-sm-4 col-form-label']) !!}
                            <div class="col-sm-8">
<<<<<<< HEAD
                                <select name="order_id[]" id="order_id" class="form-control">
                                    <option value="" selected>Select order</option>
=======
                              
                                <select name="order_id" id="order_id_1" class="form-control">
                                    <option value="" selected>Select Order Type</option>
>>>>>>> 056d438f8dd74b2d5f5eec06b60f96ecd6fba377
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
<<<<<<< HEAD
                                <select name="size_id[]" id="size_id" class="form-control">
                                    <option value="" selected>Select order</option>
=======
                                <select name="size_id" id="size_id" class="form-control">
                                    <option value="" selected>Select a size</option>
>>>>>>> 056d438f8dd74b2d5f5eec06b60f96ecd6fba377
                                </select>
                            </div>
                        </div>

                        <!--Quantity-->
                        <div class="col-3 form-group row">
<<<<<<< HEAD
                            {!! Form::label('quantity[]', 'Quantity', ['class' => 'col-sm-3 col-form-label']) !!}
=======
                            {!! Form::label('quantity', 'Quantity', ['class' => 'col-sm-3 col-form-label']) !!}
>>>>>>> 056d438f8dd74b2d5f5eec06b60f96ecd6fba377
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

<<<<<<< HEAD
                    </div>`;

                $('.dynamic-input').append(template);
            });

=======
                    </div>

                 
                </div>`;

                $('.more-inputs').append(template);
            });
        });
>>>>>>> 056d438f8dd74b2d5f5eec06b60f96ecd6fba377
</script>