<?php

//import controller
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\OrderController;
use App\Http\Controllers\Api\OrderController as ApiOrderController;


Route::group(['prefix'=>'auth'], function () {
	Route::group(['prefix'=>'user','middleware'=>'auth:sanctum'],function(){
		Route::get('/', [AuthController::class, 'getAuthenticatedUser']);
		Route::get('/orders', [OrderController::class, 'index']);
		Route::get('/orders/{orderId}', [OrderController::class, 'show']);
		Route::get('/orders/{orderId}/otp', [OrderController::class, 'requestOtp']);
		Route::get('/orders/{orderId}/otp/{otp}', [OrderController::class, 'checkOtp']);
		Route::post('/orders', [ApiOrderController::class, 'store']);
		Route::put('/orders/{orderId}', [ApiOrderController::class, 'update']);
		Route::delete('/orders/{orderId}', [ApiOrderController::class, 'delete']);
	});
	Route::post('/signup', [AuthController::class, 'signup']);
	Route::post('/login', [AuthController::class, 'login']);
	Route::post('/logout', [AuthController::class, 'logout']);
	Route::post('/password/email', [AuthController::class, 'sendPasswordResetLinkEmail'])->middleware('throttle:5,1');
	Route::post('/password/reset', [AuthController::class, 'resetPassword']);
});
