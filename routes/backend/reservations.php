<?php 

use App\Http\Controllers\Backend\ReservationController;

use Tabuna\Breadcrumbs\Trail; 

Route::middleware(['editAccess'])->group(function () {
 
    Route::get('/reservation', function () {
        return view('backend.reservation.indexmain');
    })->name('reservation.indexmain')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Reservations'), route('admin.reservation.index'));
        });

    //Maintainer------------------------------------------------------------------
    // Index
    Route::get('reservation/maintainer', [ReservationController::class, 'index'])
        ->name('reservation.index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Reservations'), route('admin.reservation.indexmain'))
                ->push(__('Maintainer'));
        });

    // Show
    Route::get('reservation/{reservation}', [ReservationController::class, 'show'])
        ->name('reservation.show')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Reservations'), route('admin.reservation.indexmain'))
                ->push(__('Maintainer'), route('admin.reservation.index'))
                ->push(__('Show'));
        });

    // Confirm 
    Route::get('reservation/{reservation}/confirm', [ReservationController::class, 'confirm'])
        ->name('reservation.confirm')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Reservations'), route('admin.reservation.indexmain'))
                ->push(__('Maintainer'), route('admin.reservation.index'))
                ->push(__('Confirm'));
        });

    // Approve
    Route::put('reservation/{reservation}', [ReservationController::class, 'approve'])
        ->name('reservation.approve');
 
});
