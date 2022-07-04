<?php


use App\Http\Controllers\LocationAPI;

Route::get('/api/v1/locations', [LocationAPI::class,'index']);
