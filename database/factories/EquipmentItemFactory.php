<?php

namespace Database\Factories;

use App\Models\EquipmentItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class EquipmentItemFactory.
 */
class EquipmentItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EquipmentItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => '',
            'title' => $this->faker->name(),
            'brand' => $this->faker->name(),
            'productCode' => 'Item-' . rand(0, 100),
            'quantity' => '1',
            'specifications' => $this->faker->text(),
            'description' => $this->faker->text(),
            'instructions' => $this->faker->text(),
            'isElectrical' => $this->faker->boolean(),
            'powerRating' => rand(100, 1000),
            'price' => rand(0, 1000),
            'width' => rand(0, 100) / 10,
            'length' => rand(0, 100) / 10,
            'height' => rand(0, 100) / 10,
            'weight' => rand(0, 1000) / 10,
            'thumb' => NULL,
            'equipment_type_id' => '11'
        ];
    }
}
