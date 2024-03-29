<?php

use App\Http\Controllers\ExampleController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

Route::get('example/{slug}', ExampleController::class)->name('example');
Route::get('{data?}', IndexController::class);
