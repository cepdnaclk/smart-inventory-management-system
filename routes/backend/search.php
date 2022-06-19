<?php

use App\Http\Controllers\Backend\SearchController;
use Tabuna\Breadcrumbs\Trail;

Route::middleware(['editAccess'])->group(function () {

    Route::get('/search', [SearchController::class,'index'])->name('search.index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Search'), route('admin.search.index'));
        });

    Route::post('/search/results', [SearchController::class,'results'])->name('search.results')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Search'), route('admin.search.index'))
                ->push(__('Results'), route('admin.search.results'));
        });
});