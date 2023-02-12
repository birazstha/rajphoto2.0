var currentBsDate = NepaliFunctions.ConvertDateFormat(
    NepaliFunctions.GetCurrentBsDate(),
    "YYYY-MM-DD"
);
$("#todays_date").val(currentBsDate);

/**Delivery date starts */
$("#delivery-date").nepaliDatePicker({
    language: "english"
});

//Add one day from the current day as delivery date
var deliveryDate = NepaliFunctions.ConvertDateFormat(
    NepaliFunctions.BsAddDays(NepaliFunctions.GetCurrentBsDate(), 1),
    "YYYY-MM-DD"
);
$("#delivery-date").val(deliveryDate);
/**Delivery date ends */
