<?php

use App\Http\Controllers\Api\SaveController;
use App\Http\Controllers\Api\ValidationController;
use Illuminate\Support\Facades\Route;

Route::post('validate', ValidationController::class)->name('validate');
Route::post('save', SaveController::class)->name('save');
