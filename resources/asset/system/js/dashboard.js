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
    const getIncomeInfo = function (data) {
        $.ajax({
            method: 'get',
            url: window.location.origin + '/rajphoto2.0/getIncome',
            data: {
                date: data,
            },
            dataType: 'html',
            success: function (response) {
                $('#income').html(response)
            },
        })
    }



    var todaysDate = NepaliFunctions.ConvertDateFormat(
        NepaliFunctions.GetCurrentBsDate(),
        'YYYY-MM-DD',
    )


    const previousDate = (date) => {
        var yesterdayDate = NepaliFunctions.ConvertDateFormat(
            NepaliFunctions.BsAddDays(NepaliFunctions.ParseDate(date).parsedDate, -1),
            'YYYY-MM-DD',
        )

        return yesterdayDate;
    };

    
    getIncomeInfo(todaysDate)





   
  

    $('#todays-date').nepaliDatePicker({
        language: 'english',
        disableDaysAfter: 0,
        disableBefore: '2079-05-24',
        onChange: function () {
            var selectedDate = $('#todays-date').val()
            $('#yesterday-date').val(previousDate(selectedDate))
            getIncomeInfo(selectedDate)
        },
    })


    $('#todays-date').val(todaysDate)
    $('#yesterday-date').val(previousDate(todaysDate))
})