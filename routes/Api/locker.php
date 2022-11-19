<?php

use App\Http\Controllers\Api\LockerController;

Route::get('locker', [LockerController::class, 'index']);
