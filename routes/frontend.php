<?php

use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/', 'dashboard\DashboardController@dashboard');
    Route::resource('bill', 'bill\BillController');
<<<<<<< HEAD
=======
    Route::post('/haha', 'TestController@getOrderById')->name('order.getSize');
>>>>>>> 056d438f8dd74b2d5f5eec06b60f96ecd6fba377
    
});