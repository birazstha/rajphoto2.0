<?php

use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/', 'dashboard\DashboardController@dashboard')->name('home');
    Route::resource('bills', 'bill\BillController');
    Route::resource('other-incomes', 'otherIncome\OtherIncomeController');

    Route::get('/qrcode', 'bill\BillController@scanQrCode')->name('bill.qrcode');
    Route::get('/search', 'bill\BillController@searchBill')->name('bill.search');
    Route::get('/search/{qr_code}', 'bill\BillController@searchBillFromIndex')->name('bill.searches');

    Route::post('/getOrderById', 'TestController@getOrderById')->name('order.getSize');
    Route::post('/getRateBySize', 'TestController@getRateBySize')->name('size.getRate');
    Route::get('/getCustomerInfo', 'TestController@getCustomerInfo')->name('bill.getCustomerInfo');
    Route::get('/getRate', 'TestController@getRate')->name('bill.getRate');
    Route::get('/getIncome', 'TestController@getIncome')->name('bill.getIncome');
    Route::post('/darkmode', 'TestController@darkmode')->name('frontend.darkmode');
    Route::get('autocompletename', 'TestController@autocompleteName')->name('autocompleteName');
    Route::get('autocompletephone', 'TestController@autocompletePhone')->name('autocompletePhone');

    Route::resource('transactions', 'transaction\transactionController');
    
    
 
});
