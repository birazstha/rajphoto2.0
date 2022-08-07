<?php

use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'Frontend','middleware' => ['language', 'pinewheel-log']], function () {
    Route::get('/', 'dashboard\DashboardController@dashboard');
    Route::resource('bill', 'bill\BillController');
    
});