<?php 

use App\Http\Controllers\Backend\ReservationController;
use Tabuna\Breadcrumbs\Trail;

Route::middleware(['editAccess'])->group(function () {

    Route::get('/reservation', function () {
        return view('backend.reservation.index');
    })->name('reservation.index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Reservation'), route('admin.reservation.index'));
        });

    // Index
    Route::get('reservation', [ReservationController::class, 'index'])
        ->name('reservation.index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Reservation'), route('admin.reservation.index'))
                ;
        });

    // Show
    Route::get('reservation/{reservation}', [ReservationController::class, 'show'])
        ->name('reservation.show')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Reservation'), route('admin.reservation.index'))
                ->push(__('Show'));
        });

});
