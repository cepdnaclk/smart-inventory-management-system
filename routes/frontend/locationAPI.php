<?php


use App\Http\Controllers\LocationAPI;

// Throttle requests to 3 every 10 mins by each IP. This is to prevent the server from being flooded with requests.
// It's only used by the CE FAQ site and Makerspace wiki anyway
Route::get('/api/v1/locations', [LocationAPI::class,'index'])->middleware("throttle:3,10");
