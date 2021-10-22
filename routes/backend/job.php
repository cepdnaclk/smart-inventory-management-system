<?php

use App\Http\Controllers\Backend\EquipmentItemController;
use App\Http\Controllers\Backend\EquipmentTypeController;
use Tabuna\Breadcrumbs\Trail;

Route::get('/jobs', function () {
    return view('backend.jobs.index');
})->name('jobs.index')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Jobs'), route('admin.jobs.index'));
    });


?>