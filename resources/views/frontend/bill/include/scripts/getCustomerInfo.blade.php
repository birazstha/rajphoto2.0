<script>
    function getCustomerInfo(searchData, dataType) {
        var path = "{{ URL::route('bill.getCustomerInfo') }}" + "?page=" + searchData;
        $.ajax({
            method: 'get',
            url: path,
            data: {
                [`${dataType}`]: searchData,
                '_token': "{{ csrf_token() }}"
            },
            dataType: 'html',
            success: function(response) {
                $('.loader').addClass('d-none');
                $('#table').html(response);
            },
        });
    }
</script>
