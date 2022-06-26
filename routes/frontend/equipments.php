<?php

use App\Http\Controllers\Frontend\EquipmentView;
use App\Models\EquipmentItem;
use App\Models\EquipmentType;
use Tabuna\Breadcrumbs\Trail;


Route::prefix('equipment')->group(function () {
    Route::get('/', [EquipmentView::class, 'index'])
        ->name('equipment.index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.index')
                ->push(__('Equipment'), route('frontend.equipment.index'));
        });

    Route::get('/category/{equipmentType}', [EquipmentView::class, 'viewCategory'])
        ->name('equipment.category')
        ->breadcrumbs(function (Trail $trail, EquipmentType $equipmentType) {
            $trail->parent('frontend.index')
                ->push(__('Equipment'), route('frontend.equipment.index'));

            if ($equipmentType->parent() != null) {
                // Only look upto two parents for now

                if ($equipmentType->parent()->parent() != null) {
                    $trail->push($equipmentType->parent()->parent()->title, route('frontend.equipment.category',
                        $equipmentType->parent()->parent()));
                }

                $trail->push($equipmentType->parent()->title, route('frontend.equipment.category',
                    $equipmentType->parent()));
            }

            $trail->push($equipmentType->title);

            
        });

    Route::get('/item/{equipmentItem}', [EquipmentView::class, 'viewItem'])
        ->name('equipment.item')
        ->breadcrumbs(function (Trail $trail, EquipmentItem $equipmentItem) {
            $trail->parent('frontend.index')
                ->push(__('Equipments'), route('frontend.equipment.index'));


            if ($equipmentItem->equipment_type() != null) {
                // Only look upto one parents for now
                $type = $equipmentItem->equipment_type;

                if ($type->parent() != null) {
                    $trail->push($type->parent()->title, route('frontend.equipment.category',
                        $type->parent()));
                }

                $trail->push($type->title, route('frontend.equipment.category',
                    $type));
            }

            $trail->push($equipmentItem->title);
        });

});
