@include('frontend.include.header')

<div class="container-fluid">
    @yield('main-content')
</div>



@yield('js')

<script>
    const themeMode = localStorage.getItem('dark-theme') || false;
    toggleThemeMode(themeMode)

    $(document).on('click', '.dark-mode', function() {
        let mode = localStorage.getItem('dark-theme')
        if (mode == "" || mode == null) {
            localStorage.setItem('dark-theme', true);
        } else if (mode == 'false') {
            localStorage.setItem('dark-theme', true);
        } else {
            localStorage.setItem('dark-theme', false);
        }
        mode = localStorage.getItem('dark-theme')
        toggleThemeMode(mode);
    });

    function toggleThemeMode(mode) {
        if (mode === 'true') {
            $('body').css("background-color", '#151515');
            $('.form').css("background-color", '#eaeaea');
            $('.table-bills').css('background', '#b3b3b3');
            $('.dark-mode-btn').html('<i class="far fa-lightbulb dark-mode ml-2" data-mode="light"></i>');
        } else {
            $('body').css("background-color", '#cccccc');
            $('.dark-mode-btn').html('<i class="fas fa-lightbulb dark-mode ml-2" data-mode="dark"></i>   ');
            $('.table-bills').css('background', 'white');

            $('.form').css("background-color", 'white');
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>

<script>
    $(document).on("click", ".open-AddBookDialog", function(e) {
        var totalAmount;
        var bill = $(this).data('bill');
        var customer = $(this).data('customer');
        $("h5").text(`Bill of ${customer.name} (${customer.phone_number})`);

        if (bill.due_amount === 0) {
            $('#cash_received').attr('readonly',true);
            $('#cash_return').attr('readonly',true);
            $('#cash_return').attr('readonly',true);
            $('#discount').attr('readonly',true);
            $('#total').attr('readonly',true);
            $(".modal-body #due_amount").val('');
            $(".modal-body #total").val('');
            $(".modal-body #due_amount").attr('type','text').val('Paid');
        } else {
            $(".modal-body #due_amount").val(bill.due_amount);
            $(".modal-body #total").val(bill.due_amount);
            $('#cash_received').attr('readonly',false);
            $('#discount').attr('readonly',false);
            $('#cash_return').attr('readonly',false);
            $('#cash_return').attr('readonly',false);
            $('#total').attr('readonly',false);
        }

        //Calculate total amount.
        $('#discount').keyup(function(){
            var dueAmount = $('#due_amount').val();
            var discountAmount = $(this).val();
            totalAmount = parseInt(dueAmount) - parseInt(discountAmount);
            $('#total').val(totalAmount);
        });

        //Calculate cash return
        $('#cash_received').blur(function(){
                var cashReceived = $(this).val();
                var total =  $('#total').val();
                var cashReturn = parseInt(cashReceived) - parseInt(total);
               $('#cash_return').val(cashReturn);
        });

     

    });
</script>



</body>

</html>
