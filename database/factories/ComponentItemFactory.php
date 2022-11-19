<?php

namespace Database\Factories;

use App\Models\ComponentItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComponentItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ComponentItem::class;

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
            'quantity' => rand(100, 1000),
            'specifications' => $this->faker->text(),
            'description' => $this->faker->text(),
            'datasheet' => $this->faker->url(),
            'price' => rand(100, 1000),
            'thumb' => NULL,
            'component_type_id' => $this->faker->randomElement(['10', '11', '12', '13', '14', '15'])

        ];
    }
}