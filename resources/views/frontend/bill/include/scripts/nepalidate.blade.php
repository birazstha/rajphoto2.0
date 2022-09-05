<script>
    window.onload = function() {
        $('#todays-date').nepaliDatePicker({

            language: "english",
            onChange: function() {
                $('.allData').addClass('d-none');
                var date = $('#todays-date').val();
                var path = "{{ URL::route('bill.getCustomerInfo') }}";
                $.ajax({
                    method: 'post',
                    url: path,
                    data: {
                        'date': date,
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

            }
        });



        var currentBsDate = NepaliFunctions.ConvertDateFormat(NepaliFunctions.GetCurrentBsDate(), 'YYYY-MM-DD');
        $('#todays-date').val(currentBsDate);
    };
</script>
