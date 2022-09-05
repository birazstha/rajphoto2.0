<script>
  
    $(document).ready(function() {

        // $('.customerName').on('keyup', function() {

        //     $('.allData').addClass('d-none');
        //     var name = $(this).val();
        //     var path = "{{ URL::route('bill.getCustomerInfo') }}";
        //     $.ajax({
        //         method: 'post',
        //         url: path,
        //         data: {
        //             'customer_name': name,
        //             '_token': "{{ csrf_token() }}"
        //         },
        //         dataType: 'html',
        //         success: function(response) {
        //             var data = response;
        //             if (data) {
        //                 $("#content").html(data);
        //             } else {
        //                 $("#content").html(
        //                     '<tr><td colspan="9" class="text-center text-danger">No data found</td></tr>'
        //                     );
        //             }


        //         },
        //     });
        // });
        $(".customerName").on("keyup", ($.debounce(1000, function() {
          $('.allData').addClass('d-none');
            var name = $(this).val();
            var path = "{{ URL::route('bill.getCustomerInfo') }}";
            $.ajax({
                method: 'post',
                url: path,
                data: {
                    'customer_name': name,
                    '_token': "{{ csrf_token() }}"
                },
                dataType: 'html',
                success: function(response) {
                    var data = response;
                    if (data) {
                        $("#content").html(data);
                    } else {
                        $("#content").html(
                            '<tr><td colspan="9" class="text-center text-danger">No data found</td></tr>'
                            );
                    }


                },
            });
        })))







    });
</script>
