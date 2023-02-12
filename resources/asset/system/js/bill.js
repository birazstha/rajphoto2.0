/** Make Name bill active when page is load */
$(document).ready(function() {
    $("#customer_name").focus();
});

$(document).on("change", "#payment_method", function() {
    var method = $(this).val();
    if (method == "online") {
        $("#toggle-payment").removeClass("d-none");
        $("#cash-transaction").addClass("d-none");
    } else {
        $("#toggle-payment").addClass("d-none");
        $("#cash-transaction").removeClass("d-none");
    }
});

$(document).ready(function() {
    $("#createBill").on("shown.bs.modal", function() {
        $("#customer_name").focus();
    });

    //Search Customer by name
    $(".search-name").autocomplete({
        classes: {
            "ui-autocomplete": "highlight"
        },
        source: function(request, response) {
            $.ajax({
                url: window.location.origin + "/rajphoto2.0/autocompleteSearch",
                type: "GET",
                dataType: "json",
                data: {
                    search: request.term
                },
                success: function(data) {
                    response(data.slice(0, 10));
                }
            });
        },
        delay: 200,
        select: function(event, ui) {
            $(".search-name").val(ui.item.label);
            $("#phone_number").val(ui.item.phone_number);
            return false;
        }
    });

    //Search Customer by phone
    $(".search-phone").autocomplete({
        classes: {
            "ui-autocomplete": "highlight"
        },
        source: function(request, response) {
            $.ajax({
                url: window.location.origin + "/rajphoto2.0/autocompletePhone",
                type: "GET",
                dataType: "json",
                data: {
                    search: request.term
                },
                success: function(data) {
                    response(data.slice(0, 10));
                }
            });
        },
        delay: 200,
        select: function(event, ui) {
            $(".search-phone").val(ui.item.label);
            return false;
        }
    });
});
