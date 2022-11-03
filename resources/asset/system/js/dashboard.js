const init = () => {
    setUpCSRF()
}

const setUpCSRF = () => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf"]').attr('content'),
        },
    })
}

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
        disableBefore: '2079-05-24',
        onChange: function () {
            var selectedDate = $('#todays-date').val()
            $('#yesterday-date').val(previousDate(selectedDate))
            getIncomeInfo(selectedDate,previousDate(selectedDate))
        },
    })



   
})