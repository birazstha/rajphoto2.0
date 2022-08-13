<?php

use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/', 'dashboard\DashboardController@dashboard')->name('home');
    Route::resource('bill', 'bill\BillController');
    Route::get('/qrcode', 'bill\BillController@scanQrCode')->name('bill.qrcode');

    Route::post('/haha', 'TestController@getOrderById')->name('order.getSize');


    
});