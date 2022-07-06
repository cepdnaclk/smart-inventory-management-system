<?php

use App\Http\Controllers\LocationAPI;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
   return $request->user();
});

Route::group(['prefix' => 'v1'], function () {
    // Throttle requests to 3 every 10 mins by each IP. This is to prevent the server from being flooded with requests.
    // It's only used by the CE FAQ site and Makerspace wiki anyway
    Route::get('/locations', [LocationAPI::class,'index'])->middleware("throttle:3,10");

});

