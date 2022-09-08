@include('frontend.bill.include.scripts.getCustomerInfo')

<script>
    var fetchBillInfoByName = function(name) {
        var data = {
            'customer_name': name,
            '_token': "{{ csrf_token() }}"
        };
        getCustomerInfo(data);
    }

    var fetchBillInfoByDate = function(date) {
        var data = {
            'date': date,
            '_token': "{{ csrf_token() }}"
        };
        getCustomerInfo(data);
    }


    $(document).ready(function() {

        var currentBsDate = NepaliFunctions.ConvertDateFormat(NepaliFunctions.GetCurrentBsDate(), 'YYYY-MM-DD');
        fetchBillInfoByDate(currentBsDate);
        $(".customerName").on("keyup", ($.debounce(500, function() {
            var name = $(this).val();
            fetchBillInfoByName(name);
        })))
    });
</script>
