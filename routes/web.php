<?php

use App\Http\Controllers\ExampleController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SaveController;
use App\Http\Controllers\ValidationController;
use Illuminate\Support\Facades\Route;

Route::post('validate', ValidationController::class);
Route::post('save', SaveController::class);
Route::get('example/{slug}', ExampleController::class);
Route::get('{data?}', IndexController::class);
