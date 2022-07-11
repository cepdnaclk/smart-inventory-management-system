<?php 

use App\Http\Controllers\Backend\ReservationController;

use Tabuna\Breadcrumbs\Trail; 

Route::middleware(['editAccess'])->group(function () {
 
    Route::get('/reservation', function () {
        return view('backend.reservation.indexmain');
    })->name('reservation.indexmain')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Reservation'), route('admin.reservation.index'));
        });

    //Maintainer------------------------------------------------------------------
    // Index
    Route::get('reservation/maintainer', [ReservationController::class, 'index'])
        ->name('reservation.index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Reservation'), route('admin.reservation.indexmain'))
                ->push(__('Maintainer'));
        });

    // Show
    Route::get('reservation/{reservation}', [ReservationController::class, 'show'])
        ->name('reservation.show')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Reservation'), route('admin.reservation.indexmain'))
                ->push(__('Maintainer'), route('admin.reservation.index'))
                ->push(__('Show'));
        });


});
