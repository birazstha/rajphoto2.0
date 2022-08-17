<?php

use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/', 'dashboard\DashboardController@dashboard')->name('home');
    Route::resource('bills', 'bill\BillController');
    Route::get('/qrcode', 'bill\BillController@scanQrCode')->name('bill.qrcode');
    Route::get('/search', 'bill\BillController@searchBill')->name('bill.search');

    Route::post('/getOrderById', 'TestController@getOrderById')->name('order.getSize');
    Route::post('/getRateBySize', 'TestController@getRateBySize')->name('size.getRate');


    
});