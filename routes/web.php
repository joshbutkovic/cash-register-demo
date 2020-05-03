<?php

use Illuminate\Support\Facades\Route;

Route::get('/{any?}', 'VueController@index');
Route::post('/transaction', 'TransactionController@create');
Route::get('/transaction/all', 'TransactionController@all');
Route::delete('/transaction/delete/{id}', 'TransactionController@delete');
