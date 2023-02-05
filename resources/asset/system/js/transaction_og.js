//For Transactions
$(document).on("ready", function() {});
const calculatetotal = function(data) {
    var quantity = $("#other_quantity").val();
    var total = quantity * data;
    $("#other_total").val(total);
};

//For showing selected transaction related titles
$(document).on("change", ".transaction-type", function() {
    let incomeType = $(this).val();
    if (incomeType === "income") {
        $(".toggle-income").removeClass("d-none");
        $(".toggle-expense").addClass("d-none");
        $("#toggle-description-income").addClass("d-none");
    } else {
        $("#transaction_title").focus();
        $(".toggle-expense").removeClass("d-none");
        $(".toggle-income").addClass("d-none");
        $("#toggle-description-income").addClass("d-none");
    }
    getTransactionType(incomeType);
});

$(".transaction_title").on("change", function() {
    let transactionType = $("#transaction-type").val();
    if (transactionType === "income") {
        var title = $("#transaction_title option:selected").text();
        if (title === "Others") {
            $(".toggle-expense").removeClass("d-none");
            $(".toggle-other-amount").removeClass("d-none");
            $(".toggle-rate").addClass("d-none");
            $("#toggle-description-income").removeClass("d-none");
            $(".toggle-other-title").removeClass("d-none");
        } else {
            $(".toggle-expense").addClass("d-none");
            $("#toggle-description-income").addClass("d-none");
            $(".toggle-other-amount").addClass("d-none");
            $(".toggle-rate").removeClass("d-none");
            $(".toggle-other-title").addClass("d-none");
        }
        var incomeTitle = $(this).val();
        $.ajax({
            method: "get",
            url: window.location.origin + "/rajphoto2.0/getRate",
            data: {
                order_id: incomeTitle,
                _token: "{{ csrf_token() }}"
            },
            dataType: "text",
            success: function(response) {
                console.log(response);
                $("#other_rate").val(response);
                calculatetotal(response);
            }
        });
    } else {
        var title = $("#transaction_title option:selected").text();
        if (title === "Other") {
            $("#toggle-description-income").removeClass("d-none");
        } else {
            $("#toggle-description-income").addClass("d-none");
        }

        if (title === "Bill Paid") {
            $(".toggle-bill-paid").removeClass("d-none");
        } else {
            $(".toggle-bill-paid").addClass("d-none");
        }
    }
});

$("#expense").change(function() {
    var title = $("#expense option:selected").text();
    if (title == "Other") {
        $("#toggle-description-expense").removeClass("d-none");
    } else {
        $("#toggle-description-expense").addClass("d-none");
    }
});

$("#other_rate").on("keyup change", function() {
    var rate = $(this).val();
    calculatetotal(rate);
});

$("#other_quantity").on("keyup change", function() {
    var quantity = $(this).val();
    var currRate = $("#other_rate").val();
    var incomeTitle = $("#other option:selected").text();

    if (incomeTitle == "EDV") {
        newTotal = parseInt(currRate) + quantity * 100 - 100;
        $("#other_total").val(newTotal);
    } else {
        var totaldd = quantity * currRate;
        $("#other_total").val(totaldd);
        $("#other_cash_received").val(totaldd);
    }
});

$("#other_cash_received").on("keyup", function() {
    var cashReceived = $(this).val();
    var total = $("#other_total").val();
    var cashReturn = cashReceived - total;
    $("#other_cash_return").val(cashReturn);
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
    getTransactionType("income");
    $("#bothTransactions").on("shown.bs.modal", function() {
        $("#transaction_title").focus();
    });
});

const getTransactionType = type => {
    $.ajax({
        method: "get",
        url: window.location.origin + "/rajphoto2.0/getTransactionTitle",
        data: {
            transactionType: type,
            _token: "{{ csrf_token() }}"
        },
        dataType: "text",
        success: function(response) {
            $(".transaction_title").empty();
            $(".transaction_title").append(response);
        }
    });

    $(document).on("keyup", ".amount", function() {
        let grandTotal = $(".grand_total").val();
        let amountPaid = $(this).val();
        dd;

        if (parseInt(amountPaid) > parseInt(grandTotal)) {
            $(".invalid-amount").removeClass("d-none");
        } else {
            $(".invalid-amount").addClass("d-none");
        }
    });
};
