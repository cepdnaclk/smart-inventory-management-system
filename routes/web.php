<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocaleController;

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
