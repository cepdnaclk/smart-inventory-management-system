<?php
use App\Http\Controllers\Backend\ComponentItemController;
use App\Http\Controllers\Backend\ComponentTypeController;
use Tabuna\Breadcrumbs\Trail;

Route::get('/component', function () {
    return view('backend.component.index');
})->name('component.name');


//component

