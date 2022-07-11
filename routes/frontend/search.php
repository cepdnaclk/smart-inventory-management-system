<?php

use App\Http\Controllers\Frontend\SearchController;
use Tabuna\Breadcrumbs\Trail;



    Route::post('/search/results', [SearchController::class, 'results'])->name('frontSearch.results')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('frontend.index'))
                ->push(__('Results'), route('frontSearch.results'));
        });
        //might have to edit the breadcrumbs - routes ^ are wrong ?

   
