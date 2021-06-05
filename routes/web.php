<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('welcome');
});

// Sign in with Google
Route::get('/google/', 'Auth\GoogleAuthController@redirect')->name('auth.google');
Route::get('/google/callback', 'Auth\GoogleAuthController@callback');


Route::group(['middleware' => 'verified'], function () {
    // Only verified users can access

    Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

    // User routes
    Route::group(['prefix' => 'user'], function () {
    Route::get('edit/{user}', 'UserController@edit')->name('user.edit');
    Route::patch('welcome/{id}', 'UserController@welcomeUpdate')->name('user.welcomeUpdate');
    Route::patch('settings/{user}', 'UserController@settings')->name('user.settings');
    Route::patch('password/{user}', 'UserController@password')->name('user.password');
    });

    // Resource Management
    Route::group(['middleware' => ['role:administrator|superadministrator']], function () {
        Route::group(['prefix' => 'admin'], function () {
            Route::resource('users', 'Admin\UsersController');
            Route::resource('permission', 'Admin\PermissionController');
            Route::resource('roles', 'Admin\RolesController');
        });
    });
});



