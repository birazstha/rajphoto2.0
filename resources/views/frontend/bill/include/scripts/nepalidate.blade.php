@include('frontend.bill.include.scripts.getCustomerInfo')
<script>
    $(document).ready(function() {
        $('#todays-date').nepaliDatePicker({
            language: "english",
            disableDaysAfter: 0,

            onChange: function() {
                $('.allData').addClass('d-none');
                var date = $('#todays-date').val();
                var data = {
                    'date': date,
                    '_token': "{{ csrf_token() }}"
                };
                getCustomerInfo(data);
            }
        });
        var currentBsDate = NepaliFunctions.ConvertDateFormat(NepaliFunctions.GetCurrentBsDate(), 'YYYY-MM-DD');
        $('#todays-date').val(currentBsDate);
    });
</script>
