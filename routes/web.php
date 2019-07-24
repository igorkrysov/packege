<?php

Route::group(['middleware' => 'web'], function () {
    Route::get('currency/upload', 'Techsmart\Currency\Http\Controllers\CurrencyController@upload')->middleware('web');


    Route::post('currency/store', 'Techsmart\Currency\Http\Controllers\CurrencyController@store')->name('currency.store');
    
    
    Route::get('currency/{currency}', 'Techsmart\Currency\Http\Controllers\CurrencyController@show')->name('currency.show');
  });
