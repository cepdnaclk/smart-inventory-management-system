<?php

namespace Database\Factories;

use App\Models\ComponentType;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComponentTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ComponentType::class;

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
            'isAvailable' => $this->faker->text(),
            'isElectrical' => $this->faker->boolean(),
            'powerRating' => rand(100, 1000),
            'price' => rand(0, 1000),
            'size' => $this->faker->randomElement(['very small', 'small',  'medium','regular', 'large', 'very large']),
            'thumb' => NULL,
            'equipment_type_id' => '11'
        ];
    }
}
