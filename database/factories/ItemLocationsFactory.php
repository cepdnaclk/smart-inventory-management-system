<?php

namespace Database\Factories;

use App\Models\ComponentItem;
use App\Models\EquipmentItem;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemLocationsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $item = EquipmentItem::all()->random(1)->first();
        $inventory_code = $item->inventoryCode();
        return [
            'location_id' => '1',
            'item_id' => $inventory_code
        ];
    }
}
