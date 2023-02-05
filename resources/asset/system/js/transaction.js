//For Transactions
$(document).on("ready", function() {});
const calculatetotal = function(data) {
    var quantity = $("#other_quantity").val();
    var total = quantity * data;
    $("#other_total").val(total);
};

$(document).on("change", "#income_title", function() {
    var title = $("#income_title option:selected").text();
    if (title === "Urgent") {
        $(".toggle-size").removeClass("d-none");
    } else {
        $(".toggle-size").addClass("d-none");
    }

    if (title === "Others") {
        $("#toggle-description-income").removeClass("d-none");
    } else {
        $("#toggle-description-income").addClass("d-none");
    }
});

$(document).on("change", ".payment_method_other", function() {
    var method = $(this).val();
    if (method == "online") {
        $(".toggle-payment-other").removeClass("d-none");
        $("#cash-transaction-other").addClass("d-none");
    } else {
        $(".toggle-payment-other").addClass("d-none");
        $("#cash-transaction-other").removeClass("d-none");
    }
});

$(document).ready(function() {
    $("#income_title").focus();
    $("#expense_title").focus();
});

$(document).ready(function() {
    $(".size_title").on("change", function() {
        let sizeId = $(this).val();
        $.ajax({
            method: "get",
            url: window.location.origin + "/rajphoto2.0/getRateBySize",
            data: {
                size_id: sizeId,
                _token: "{{ csrf_token() }}"
            },
            dataType: "text",
            success: function(response) {
                $("#income_amount").val(response);
            }
        });
    });
});

$(document).ready(function() {
    $(".transaction_title").on("change", function() {
        let incomeId = $(this).val();
        $.ajax({
            method: "get",
            url: window.location.origin + "/rajphoto2.0/getRate",
            data: {
                order_id: incomeId,
                _token: "{{ csrf_token() }}"
            },
            dataType: "text",
            success: function(response) {
                $("#income_amount").val(response);
            }
        });
    });
});
