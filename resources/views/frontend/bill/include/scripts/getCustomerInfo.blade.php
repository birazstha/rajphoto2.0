<script>
    function getCustomerInfo(data) {
        var path = "{{ URL::route('bill.getCustomerInfo') }}" + "?page=" + data ;
        $.ajax({
            method: 'get',
            url: path,
            data: data,
            dataType: 'html',
            success: function(response) {
                $('.loader').addClass('d-none');
                $('#table').html(response);
       
            },
        });

    }
</script>
