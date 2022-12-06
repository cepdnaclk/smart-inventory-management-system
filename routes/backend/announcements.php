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
    Route::post('announcements', [AnnouncementController::class, 'store'])
        ->name('annoncements.store');

    // Show
    Route::get('announcements/{annoucement}', [AnnouncementController::class, 'show'])
        ->name('annoncements.show')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Announcements'), route('admin.announcements.index'))
                ->push(__('Show'));
        });

    // Edit
    Route::get('announcements/edit/{annoucement}', [AnnouncementController::class, 'edit'])
        ->name('annoncements.edit')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Announcements'), route('admin.announcements.index'))
                ->push(__('Edit'));
        });

    // Update
    Route::put('announcements/{componentItem}', [AnnouncementController::class, 'update'])
        ->name('annoncements.update');

    // Delete
    Route::get('announcements/delete/{componentItem}', [AnnouncementController::class, 'delete'])
        ->name('annoncements.delete')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Announcements'), route('admin.component.index'))
                ->push(__('Delete'));
        });

    // Destroy
    Route::delete('announcements/{componentItem}', [ComponentItemController::class, 'destroy'])
        ->name('annoncements.destroy');
});