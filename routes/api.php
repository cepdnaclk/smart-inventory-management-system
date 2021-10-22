<?php
//import controller
use App\Http\Controllers\API\AuthenticationController;

//register new user
Route::post('/create-account', [AuthenticationController::class, 'createAccount']);
//login user
Route::post('/signin', [AuthenticationController::class, 'signin']);
//using middleware
Route::group(['prefix'=>'user','middleware' => ['auth:sanctum']], function () {
    Route::get('/', function(Request $request) {
        return auth('api')->user();
    });
    Route::post('/signout', [AuthenticationController::class, 'signout']);
});
