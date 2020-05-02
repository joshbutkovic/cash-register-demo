<?php

use Illuminate\Support\Facades\Route;

Route::get('/{any?}', 'VueController@index');
Route::post('/transaction', 'VueController@createTransaction');
