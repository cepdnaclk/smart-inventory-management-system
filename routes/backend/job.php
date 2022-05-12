<?php

use App\Http\Controllers\Backend\EquipmentItemController;
use App\Http\Controllers\Backend\EquipmentTypeController;
use App\Http\Controllers\Backend\JobRequestsController;
use Tabuna\Breadcrumbs\Trail;

Route::get('/jobs', function () {
    return view('backend.jobs.index');
})->name('jobs.index')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Fabrications'), route('admin.jobs.index'));
    });

// Student Routes ---------------------------------------------------------------------------------

// Create
Route::get('/jobs/create', [JobRequestsController::class, 'create'])
    ->name('jobs.create')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Fabrications'), route('admin.jobs.index'))
            ->push(__('Create'));
    });

// Store
Route::post('/jobs', [JobRequestsController::class, 'store'])
    ->name('jobs.store');






// Supervisor Routes ----------------------------------------------------------------------------

// Index
Route::get('/jobs/supervisor', function () {
    return view('backend.jobs.supervisor.index');
})->name('jobs.supervisor.index')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Fabrications'), route('admin.jobs.index'))
            ->push(__('Supervisor'), route('admin.jobs.supervisor.index'));;
    });
// Show
Route::get('/jobs/supervisor/{job}', [JobRequestsController::class, 'supervisor_show'])
    ->name('jobs.supervisor.show')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Fabrications'), route('admin.jobs.index'))
            ->push(__('Supervisor'), route('admin.jobs.supervisor.index'))
            ->push(__('Show'));
    });
// Store
Route::post('/jobs/supervisor/', [JobRequestsController::class, 'supervisor_store'])
    ->name('jobs.supervisor.store');




// Technical Officer Routes ----------------------------------------------------------------------------

Route::get('/jobs/technical-officer', function () {
    return view('backend.jobs.technical-officer.index');
})->name('jobs.techo.index')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Fabrications'), route('admin.jobs.index'))
            ->push(__('Technical Officer'), route('admin.jobs.techo.index'));;
    });
// Show
Route::get('/jobs/technical-officer/{job}', [JobRequestsController::class, 'techo_show'])
    ->name('jobs.techo.show')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Fabrications'), route('admin.jobs.index'))
            ->push(__('Technical Officer'), route('admin.jobs.techo.index'))
            ->push(__('Show'));
    });
// Store
Route::post('/jobs/technical-officer/', [JobRequestsController::class, 'techo_store'])
    ->name('jobs.techo.store');

?>
