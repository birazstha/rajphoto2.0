
$(function () {

   
    const getIncomeInfo =  (data,previousDate) => {
        
        $.ajax({
            method: 'get',
            url: window.location.origin + '/rajphoto2.0/getIncome',
            data: {
                date: data,
                prevDate: previousDate,
                
            },
            dataType: 'html',
            success: function (response) {
                $('#income').html(response)
            },
        })
    }

    const previousDate = (date) => {
        var yesterdayDate = NepaliFunctions.ConvertDateFormat(
            NepaliFunctions.BsAddDays(NepaliFunctions.ParseDate(date).parsedDate, -1),
            'YYYY-MM-DD',
        )
        return yesterdayDate;
    };



    var todaysDate = NepaliFunctions.ConvertDateFormat(
        NepaliFunctions.GetCurrentBsDate(),
        'YYYY-MM-DD',
    )

    getIncomeInfo(todaysDate,previousDate(todaysDate))

    //Setting Todays date at Dashboard.
    $('#todays-date').val(todaysDate)
    $('#yesterday-date').val(previousDate(todaysDate))


    $('#todays-date').nepaliDatePicker({
        language: 'english',
        disableDaysAfter: 0,
        disableBefore: '2079-07-21',
        onChange: function () {
            var selectedDate = $('#todays-date').val()
            $('#yesterday-date').val(previousDate(selectedDate))
            getIncomeInfo(selectedDate,previousDate(selectedDate))
        },
    })

    $(document).on('blur','#closing_balance',function(){
       var cashInDrawer = $(this).val();
       var closingBalance = $('#closing').val();
      
       var netClosingBalance = cashInDrawer - closingBalance;

       $('#adjustment').val(netClosingBalance);
    

        
    });
   



   
})