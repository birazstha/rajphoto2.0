<?php

use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/', 'dashboard\DashboardController@dashboard')->name('home');
    Route::resource('bills', 'bill\BillController');
    Route::resource('expense', 'expense\ExpenseController');
    Route::resource('bank', 'bank\BankController');

    Route::get('/qrcode', 'bill\BillController@scanQrCode')->name('bill.qrcode');
    Route::get('/search', 'bill\BillController@searchBill')->name('bill.search');
    Route::get('/search/{qr_code}', 'bill\BillController@searchBillFromIndex')->name('bill.searches');

    Route::post('/getOrderById', 'AjaxController@getOrderById')->name('order.getSize');
    Route::get('/getRateBySize', 'AjaxController@getRateBySize')->name('size.getRate');
    Route::get('/getCustomerInfo', 'AjaxController@getCustomerInfo')->name('bill.getCustomerInfo');
    Route::get('/getRate', 'AjaxController@getRate')->name('bill.getRate');
    Route::get('/getIncome', 'AjaxController@getIncome')->name('bill.getIncome');
    Route::get('/getOpeningBalance', 'AjaxController@getOpeningBalance')->name('bill.getOpeningBalance');
    Route::post('/darkmode', 'AjaxController@darkmode')->name('frontend.darkmode');
    Route::get('autocompletephone', 'AjaxController@autocompletePhone')->name('autoCompletePhone');
    Route::get('getTransactionTitle', 'AjaxController@getTransactionTitle')->name('getTransactionTitle');

    Route::get('autocompleteSearch', 'AjaxController@autoCompleteSearch')->name('autoCompleteSearch');


    Route::resource('transactions', 'transaction\TransactionController');

    Route::get('/income', 'transaction\TransactionController@income')->name('transactions.income');
    Route::get('/expense', 'transaction\TransactionController@expense')->name('transactions.expense');



    Route::resource('customers', 'customer\customerController');
    Route::get('customer/{id}', 'customer\customerController@search')->name('customerResult');
    Route::post('/adjustment', 'adjustment\AdjustmentController@store')->name('frontend.adjustment.store');

    Route::get('/transaction-filter/{type}', 'dashboard\DashboardController@filter')->name('filter.trasactions');

    Route::get('/analytics', 'chart\ChartController@index')->name('analytics');
});
