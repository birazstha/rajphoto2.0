@include('frontend.bill.include.scripts.getCustomerInfo')
<script>
    var currentBsDate = NepaliFunctions.ConvertDateFormat(NepaliFunctions.GetCurrentBsDate(), 'YYYY-MM-DD');

    $(document).ready(function() {
        //Fetch the bills of todays NP date onload.
        var currentBsDate = NepaliFunctions.ConvertDateFormat(NepaliFunctions.GetCurrentBsDate(), 'YYYY-MM-DD');
        getCustomerInfo(currentBsDate, 'date');

        //Fetch bills according the the name entered
        $(".customerName").on("keydown", ($.debounce(300, function(e) {
            var customerName = $(this).val();
            // if (e.which == 13) {
            //     //If customer name is given search the bill according to it..
            //     if (customerName.length > 0) {
            //         getCustomerInfo(customerName, 'customer_name');
            //     }
            //     //If name is not given, show todays biull.
            //     else {
            //         getCustomerInfo(currentBsDate, 'date');
            //     }
            // }


            //If customer name is given search the bill according to it..
            if (customerName.length > 0) {
                getCustomerInfo(customerName, 'customer_name');
            }
            //If name is not given, show todays biull.
            else {
                getCustomerInfo(currentBsDate, 'date');
                $('#todays-date').val(currentBsDate);
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
        $('#todays-date').val(currentBsDate);

    });
</script>
