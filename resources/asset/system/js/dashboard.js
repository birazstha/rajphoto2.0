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
        yesterdayDate: yesterdayDate,
      },
      dataType: 'html',
      success: function (response) {
        $('#income').html(response)
      },
    })
  }

  const getOpeningBalance = function (deliveryDate) {
    $.ajax({
      method: 'get',
      url: window.location.origin + '/rajphoto2.0/getOpeningBalance',
      data: {
        date: deliveryDate,
    
      },
      dataType: 'html',
      success: function (response) {
        console.log(response);
        $('#income').html(response)
      },
    })
  }

  var todaysDate = NepaliFunctions.ConvertDateFormat(
    NepaliFunctions.GetCurrentBsDate(),
    'YYYY-MM-DD',
  )
  var yesterdayDate = NepaliFunctions.ConvertDateFormat(
    NepaliFunctions.BsAddDays(NepaliFunctions.GetCurrentBsDate(), -1),
    'YYYY-MM-DD',
  )

  getIncomeInfo(todaysDate)
  getOpeningBalance(yesterdayDate)

  $('#todays-date').nepaliDatePicker({
    language: 'english',
    disableDaysAfter: 0,
    disableBefore: '2079-05-24',
    onChange: function () {
      var selectedDate = $('#todays-date').val()
      getIncomeInfo(selectedDate)
    },
  })
  $('#todays-date').val(todaysDate)
})
