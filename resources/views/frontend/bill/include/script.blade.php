<script>

    $(document).ready(function ()
    {
        //alert('hello');
        console.log('hello');

        $('#order_id').change(function ()
        {

            //alert('selected');
            var order=$(this).val();
            //alert(order);
            var path="{{URL::route('backend.order.getSize')}}";

            $.ajax({

                url:path,
                data:{'order_id':order,'_token':$('meta[name="csrf-token"]').attr('content')},
                method:'post',
                dataType:'text',
                success:function(response)
                {
                    // console.log(response);
                    $('#size_id').empty();
                    $('#size_id').append(response);
                }
            });
        });

        $('#size_id').change(function ()
        {

            //alert('selected');
            var size=$(this).val();
            var path="{{URL::route('backend.size.getRate')}}";

            $.ajax({

                url:path,
                data:{'size_id':size,'_token':$('meta[name="csrf-token"]').attr('content')},
                method:'post',
                dataType:'text',
                success:function(data)
                {
                   //console.log(response);

                    $('#rate').val(data);
                }
            });
        });


        $('#quantity').change(function ()
        {

            //alert('selected');
            var quantity=$(this).val();
            //alert(quantity);
            var path="{{URL::route('backend.size.getRateByQty')}}";

            $.ajax({

                url:path,
                data:{'quantity':quantity,'_token':$('meta[name="csrf-token"]').attr('content')},
                method:'post',
                dataType:'text',
                success:function(data)
                {
                    //console.log(response);

                    $('#rate').val(data);
                }
            });
        });


    });
</script>

