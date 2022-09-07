@include('frontend.bill.include.scripts.getCustomerInfo')

<script>

var fetchBillInfo = function(name) {
        var path = "{{ URL::route('bill.getCustomerInfo') }}";
        var data = {
                'customer_name': name,
                '_token': "{{ csrf_token() }}"
            };
            getCustomerInfo(data);
    }

    $(document).ready(function() {
        fetchBillInfo();    
        $(".customerName").on("keyup", ($.debounce(500, function() {
            var name = $(this).val();
            fetchBillInfo(name);
        })))
    });
</script>
