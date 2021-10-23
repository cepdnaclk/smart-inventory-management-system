<?php

//import controller
use App\Http\Controllers\Api\Auth\AuthController;
use Doctrine\DBAL\Driver\Middleware;

Route::group(['prefix'=>'auth'], function () {
	Route::group(['prefix'=>'user','middleware'=>'auth'],function(){
		Route::get('/', [AuthController::class, 'getAuthenticatedUser']);
	});
	Route::post('/signup', [AuthController::class, 'signup']);
	Route::post('/login', [AuthController::class, 'login']);
	Route::post('/logout', [AuthController::class, 'logout']);
	Route::post('/password/email', [AuthController::class, 'sendPasswordResetLinkEmail'])->middleware('throttle:5,1');
	Route::post('/password/reset', [AuthController::class, 'resetPassword']);
});
