<?php

use App\Http\Controllers\Backend\OrderController;
use App\Models\Order;
use Tabuna\Breadcrumbs\Trail;

//Technical Officer Routes ----------------------------------------------------------------------------
Route::middleware(['role:Administrator|Technical Officer'])->group(function () {
    
    //index
    Route::get('/orders/officer/index', [OrderController::class, 'officer_index'])
    ->name('orders.officer.index')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Orders'), route('admin.orders.index'))
            ->push(__('Technical Officer'), route('admin.orders.officer.index'));
    });

    // approved orders index
    Route::get('/orders/officer/approved', [OrderController::class, 'officer_index_for_approved_orders'])
        ->name('orders.officer.approved.index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Orders'), route('admin.orders.index'))
            ->push(__('Technical Officer'), route('admin.orders.officer.index'))
            ->push(__('Approved Orders'), route('admin.orders.officer.approved.index'));
        });

    // submitted orders index
    Route::get('/orders/officer/submitted', [OrderController::class, 'officer_submitted_orders_index'])
        ->name('orders.officer.submitted.index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Orders'), route('admin.orders.index'))
            ->push(__('Technical Officer'), route('admin.orders.officer.index'))
            ->push(__('Submitted Orders'), route('admin.orders.officer.submitted.index'));
        });

    // Show
    Route::get('/orders/officer/{orderRequest}/view', [OrderController::class, 'officer_show'])
    ->name('orders.officer.show')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Orders'), route('admin.orders.index'))
            ->push(__('Technical Officer'), route('admin.orders.officer.index'))
            ->push(__('Show'));
    });

    // approved order confirm
    Route::get('orders/officer/approved/{orderRequest}/confirm/', [OrderController::class, 'officer_confirm_for_approved_orders'])
        ->name('orders.officer.approved.confirm')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Orders'), route('admin.orders.index'))
                ->push(__('Technical Officer'), route('admin.orders.officer.index'))
                ->push(__('Approved Orders'), route('admin.orders.officer.approved.index'))
                ->push(__('Confirm'));
        });

    // submitted order confirm
    Route::get('orders/officer/submitted/{orderRequest}/confirm/', [OrderController::class, 'officer_confirm_for_submitted_orders'])
        ->name('orders.officer.submitted.confirm')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Orders'), route('admin.orders.index'))
                ->push(__('Technical Officer'), route('admin.orders.officer.index'))
                ->push(__('Submitted Orders'), route('admin.orders.officer.submitted.index'))
                ->push(__('Confirm'));
        });

    // Ready
    Route::post('/orders/officer/{orderRequest}/ready/', [OrderController::class, 'officer_ready'])
        ->name('orders.officer.ready');

    // Finish
    Route::get('/orders/officer/{orderRequest}/finish', [OrderController::class, 'officer_finish'])
    ->name('orders.officer.finish');

});
//-----------------------------------------------------------------------------------------------------------

// Lecturer Order request  Routes ----------------------------------------------------------------------------
Route::middleware(['role:Administrator|Lecturer'])->group(function () {

 // index
 Route::get('/orders/lecturer', [OrderController::class, 'lecturer_index'])
 ->name('orders.lecturer.index')
 ->breadcrumbs(function (Trail $trail) {
     $trail->push(__('Home'), route('admin.dashboard'))
         ->push(__('Requests'),);
 });



 // Show
 Route::get('/orders/lecturer/{order}/view/', [OrderController::class, 'lecturer_show'])
 ->name('orders.lecturer.show')
 ->breadcrumbs(function (Trail $trail) {
     $trail->push(__('Home'), route('admin.dashboard'))
         ->push(__('Requests'), route('admin.orders.lecturer.index'))
         ->push(__('Show'));
 });

     // Store the different types of updates
     Route::get('/orders/lecturer/{order}/approve/', [OrderController::class, 'lecturer_approve'])
     ->name('orders.lecturer.approve');
     Route::get('/orders/lecturer/{order}/rejected/', [OrderController::class, 'lecturer_reject'])
     ->name('orders.lecturer.rejected');

      // accepted index
 Route::get('/orders/lecturer/accepted', [OrderController::class, 'lecturer_accepted_index'])
 ->name('orders.lecturer.accepted.index')
 ->breadcrumbs(function (Trail $trail) {
     $trail->push(__('Home'), route('admin.dashboard'))
         ->push(__('Requests'),);
 });

 //Rejected index
 Route::get('/orders/lecturer/rejected', [OrderController::class, 'lecturer_rejected_index'])
 ->name('orders.lecturer.rejected.index')
 ->breadcrumbs(function (Trail $trail) {
     $trail->push(__('Home'), route('admin.dashboard'))
         ->push(__('Requests'),);
 });

});
//----------------------------------------------------------------------------------------------------------------

//----------------------H_O_D Routes--------------------------//


Route::middleware(['permission:lecturer.access.hod'])->group(function () {
Route::get('/orders/hod', [OrderController::class, 'h_o_d_index'])
->name('orders.h_o_d.index')
->breadcrumbs(function (Trail $trail) {
    $trail->push(__('Home'), route('admin.dashboard'))
        ->push(__('Requests'),);
});

 // Show
 Route::get('/orders/hod/{order}/view/', [OrderController::class, 'h_o_d_show'])
 ->name('orders.h_o_d.show')
 ->breadcrumbs(function (Trail $trail) {
     $trail->push(__('Home'), route('admin.dashboard'))
         ->push(__('Requests'), route('admin.orders.h_o_d.index'))
         ->push(__('Show'));
 });
// Store the different types of updates
Route::get('/orders/hod/{order}/approve/', [OrderController::class, 'h_o_d_approve'])
->name('orders.h_o_d.approve');
Route::get('/orders/hod/{order}/rejected/', [OrderController::class, 'h_o_d_reject'])
->name('orders.h_o_d.rejected');

      // accepted index
      Route::get('/orders/hod/accepted', [OrderController::class, 'h_o_d_accepted_index'])
      ->name('orders.h_o_d.accepted.index')
      ->breadcrumbs(function (Trail $trail) {
          $trail->push(__('Home'), route('admin.dashboard'))
              ->push(__('Requests'),);
      });

       //Rejected index
 Route::get('/orders/hod/rejected', [OrderController::class, 'h_o_d_rejected_index'])
 ->name('orders.h_o_d.rejected.index')
 ->breadcrumbs(function (Trail $trail) {
     $trail->push(__('Home'), route('admin.dashboard'))
         ->push(__('Requests'),);
 });

});



//-----------------------------------------------------






Route::get('/orders', [OrderController::class, 'index'])
->name('orders.index')
->breadcrumbs(function (Trail $trail) {
    $trail->push(__('Home'), route('admin.dashboard'))
        ->push(__('Orders'), route('admin.orders.index'));
});

// Create
Route::get('orders/create', [OrderController::class, 'create'])
    ->name('orders.create')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Orders'), route('admin.orders.index'))
            ->push(__('Create'));
    });


// Store
Route::post('orders', [OrderController::class, 'store'])
    ->name('orders.store');

// Show
Route::get('orders/{order}', [OrderController::class, 'show'])
    ->name('orders.show')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Orders'), route('admin.orders.index'))
            ->push(__('Show'));
});

// Edit
Route::get('orders/edit/{order}', [OrderController::class, 'edit'])
    ->name('orders.edit')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Orders'), route('admin.orders.index'))
            ->push(__('Edit'));
});


// Update
Route::put('orders/{order}', [OrderController::class, 'update'])
->name('orders.update');

// Delete
Route::get('orders/delete/{order}', [OrderController::class, 'delete'])
    ->name('orders.delete')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Orders'), route('admin.orders.index'))
            ->push(__('Delete'));
});

// Destroy
Route::delete('orders/{order}', [OrderController::class, 'destroy'])
    ->name('orders.destroy');


?>