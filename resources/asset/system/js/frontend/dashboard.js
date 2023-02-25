$(function() {
    const getIncomeInfo = (data, previousDate) => {
        $.ajax({
            method: "get",
            url: window.location.origin + "/rajphoto2.0/getDashboardInfo",
            data: {
                date: data,
                prevDate: previousDate
            },
            dataType: "html",
            success: function(response) {
                $("#dashboard").html(response);
            }
        });
    };

    const previousDate = date => {
        var yesterdayDate = NepaliFunctions.ConvertDateFormat(
            NepaliFunctions.BsAddDays(
                NepaliFunctions.ParseDate(date).parsedDate,
                -1
            ),
            "YYYY-MM-DD"
        );
        return yesterdayDate;
    };

    var todaysDate = NepaliFunctions.ConvertDateFormat(
        NepaliFunctions.GetCurrentBsDate(),
        "YYYY-MM-DD"
    );

    getIncomeInfo(todaysDate, previousDate(todaysDate));

    //Setting Todays date at Dashboard.
    $("#todays-date").val(todaysDate);
    $("#yesterday-date").val(previousDate(todaysDate));

    $("#todays-date").nepaliDatePicker({
        language: "english",
        disableDaysAfter: 0,
        disableBefore: "2079-10-25",
        onChange: function() {
            var selectedDate = $("#todays-date").val();
            $("#yesterday-date").val(previousDate(selectedDate));
            getIncomeInfo(selectedDate, previousDate(selectedDate));
        }
    });

    $(document).on("keyup", "#closing_balance", function() {
        var cashInDrawer = $(this).val();
        var closingBalance = $("#closing").val();

        var netClosingBalance = cashInDrawer - closingBalance;

        $("#adjustment").val(netClosingBalance);
    });

    $(document).on("change", "#transactions", function() {
        let title = $(this).val();
        $.ajax({
            method: "get",
            url: window.location.origin + "/rajphoto2.0/getTransactions",
            data: {
                title: title
            },
            dataType: "html",
            success: function(response) {
                $("#transaction_detail").html(response);
            }
        });
    });
});
