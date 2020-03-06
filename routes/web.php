<?php

use Illuminate\Support\Facades\Route;

Route::post('validate', 'ValidationController');
Route::post('save', 'SaveController');
Route::get('example/{slug}', 'ExampleController');
Route::get('{data?}', 'IndexController');
