var currentBsDate = NepaliFunctions.ConvertDateFormat(
    NepaliFunctions.GetCurrentBsDate(),
    "YYYY-MM-DD"
);

var yesterdayDate = NepaliFunctions.ConvertDateFormat(
    NepaliFunctions.BsAddDays(
        NepaliFunctions.ParseDate(currentBsDate).parsedDate,
        -1
    ),
    "YYYY-MM-DD"
);

$("#todays_date").val(currentBsDate);
$("#yesterdays_date").val(yesterdayDate);
