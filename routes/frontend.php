<?php

use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/', 'dashboard\DashboardController@dashboard');
    Route::resource('bill', 'bill\BillController');
    Route::post('/haha', 'TestController@getOrderById')->name('order.getSize');
    
});