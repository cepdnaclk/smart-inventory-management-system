<?php

use App\Http\Controllers\LocationAPI;
use Illuminate\Http\Request;

/*
 * API Routes
 */
Route::group(['as' => 'api.'], function () {
    includeRouteFiles(__DIR__.'/api/');
});

Route::group(['prefix' => 'v1'], function () {
    // Throttle requests to 3 every 10 mins by each IP. This is to prevent the server from being flooded with requests.
    // It's only used by the CE FAQ site and Makerspace wiki anyway
    Route::get('/locations', [LocationAPI::class,'index'])->middleware("throttle:3,10");

});


