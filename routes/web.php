<?php

Route::get('currency/upload', 'CurrencyController@upload');


Route::post('currency/store', 'CurrencyController@store');


Route::get('currency/{currency}', 'CurrencyController@show')->name('currency.show');