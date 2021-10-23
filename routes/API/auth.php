<?php

//import controller


// All route names are prefixed with 'admin.auth'.


//register new user

use App\Http\Controllers\Api\Auth\AuthController;

// Route::post('/create-account', [AuthController::class, 'createAccount']);
// //login user
// Route::post('/login', [AuthController::class, 'login']);
// //using middleware
// Route::group(['prefix'=>'user','middleware' => ['auth:sanctum']], function () {
//     Route::get('/', function(Request $request) {
//         return auth('api')->user();
//     });
//     Route::post('/signout', [AuthController::class, 'signout']);
// });


Route::group(['prefix'=>'auth'], function () {
	Route::get('/user', [AuthController::class, 'getAuthenticatedUser']);
	Route::post('/signup', [AuthController::class, 'signup']);
	Route::post('/login', [AuthController::class, 'login']);
	Route::post('/logout', [AuthController::class, 'logout']);
	Route::post('/password/email', [AuthController::class, 'sendPasswordResetLinkEmail'])->middleware('throttle:5,1');
	Route::post('/password/reset', [AuthController::class, 'resetPassword']);
});
