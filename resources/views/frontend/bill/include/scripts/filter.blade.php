@include('frontend.bill.include.scripts.getCustomerInfo')
<script>
    $(document).ready(function() {
        //Fetch the bills of todays NP date onload.
        var currentBsDate = NepaliFunctions.ConvertDateFormat(NepaliFunctions.GetCurrentBsDate(), 'YYYY-MM-DD');
        getCustomerInfo(currentBsDate, 'date');

        //Fetch bills according the the name entered
        $(".customerName").on("keyup", ($.debounce(500, function() {
            var dataType = 'customer_name';
            var customerName = $(this).val();

            //If customer name is given search the bill according to it..
            if (customerName.length > 0) {
                getCustomerInfo(customerName, 'customer_name');
            }
            //If name is not given, show todays biull.
            else{
                var selectedDate = $('#todays-date').val();
                getCustomerInfo(selectedDate, 'date');
            }

        })))

        //Search bill by Nepali date
        $('#todays-date').nepaliDatePicker({
            language: "english",
            disableDaysAfter: 0,
            onChange: function() {
                $('.allData').addClass('d-none');
                var selectedDate = $('#todays-date').val();
                getCustomerInfo(selectedDate, 'date');
            }
        });
        var currentBsDate = NepaliFunctions.ConvertDateFormat(NepaliFunctions.GetCurrentBsDate(), 'YYYY-MM-DD');
        $('#todays-date').val(currentBsDate);

    });
</script>
