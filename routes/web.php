<?php

Route::post('validate', 'ValidationController');
Route::post('save', 'SaveController');
Route::get('{data?}', 'IndexController');
