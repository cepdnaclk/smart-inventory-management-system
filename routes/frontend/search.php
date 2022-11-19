<?php

use App\Http\Controllers\Frontend\SearchController;
use Tabuna\Breadcrumbs\Trail;


Route::get('/search/results/', [SearchController::class, 'results'])->name('frontSearch.results')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('frontend.index'))
            ->push(__('Results'), route('frontend.frontSearch.results'));
    });
