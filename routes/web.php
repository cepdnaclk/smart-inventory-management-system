<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\Registered\CalendarController;
use App\Http\Controllers\FullCalendarController;
use App\Http\Controllers\Frontend\StationController;


/*
 * Global Routes
 *
 * Routes that are used between both frontend and backend.
 */
 
// Switch between the included languages
Route::get('lang/{lang}', [LocaleController::class, 'change'])->name('locale.change');

/*
 * Frontend Routes
 */
Route::group(['as' => 'frontend.'], function () {
    includeRouteFiles(__DIR__ . '/frontend/');
});


/*
 * Backend Routes
 *
 * These routes can only be accessed by users with type `admin`
 */

Route::prefix('admin')->as('admin.')->middleware(['auth'])->group(function () {
    includeRouteFiles(__DIR__ . '/backend/');
});

/*
 * Registered user Routes
 *
 * These routes can only be accessed by registered users
 */

Route::prefix('user')->as('user.')->middleware(['auth'])->group(function () {
    includeRouteFiles(__DIR__ . '/registered/');
});

