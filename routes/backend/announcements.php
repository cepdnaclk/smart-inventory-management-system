<?php

use Tabuna\Breadcrumbs\Trail;
use App\Http\Controllers\Backend\AnnouncementController;

Route::middleware(['editAccess'])->group(function () {

    Route::get('/announcements', function () {
        return view('backend.announcements.index');
    })->name('announcements.index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Announcements'), route('admin.announcements.index'));
        });

    // Create
    Route::get('announcements/create', [AnnouncementController::class, 'create'])
        ->name('announcements.create')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Announcements'), route('admin.announcements.index'))
                ->push(__('Create'));
        });

    // Store
    Route::post('announcements/', [AnnouncementController::class, 'store'])
        ->name('announcements.store');

    // Edit
    Route::get('announcements/edit/{announcement}', [AnnouncementController::class, 'edit'])
        ->name('announcements.edit')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Announcements'), route('admin.announcements.index'))
                ->push(__('Edit'));
        });

    // Update
    Route::put('announcements/{announcement}', [AnnouncementController::class, 'update'])
        ->name('announcements.update');

    // Delete
    Route::get('announcements/delete/{announcement}', [AnnouncementController::class, 'delete'])
        ->name('announcements.delete')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Announcements'), route('admin.component.index'))
                ->push(__('Delete'));
        });

    // Destroy
    Route::delete('announcements/{announcement}', [AnnouncementController::class, 'destroy'])
        ->name('announcements.destroy');
});
