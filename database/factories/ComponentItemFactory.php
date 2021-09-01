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
            'instructions' => $this->faker->text(),
            'isAvailable' => '1',
            'isElectrical' => '1',
            'powerRating' => rand(100, 1000),
            'price' => rand(0, 1000),
            'size' => $this->faker->randomElement(['very small', 'small',  'medium','regular', 'large', 'very large']),
            'thumb' => NULL,
            'component_type_id' => $this->faker->randomElement(['11','12'])
            
        ];
    }
}
