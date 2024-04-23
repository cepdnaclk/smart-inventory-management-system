<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ConsumableItemFactory extends Factory
{
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
            'quantity' => rand(100, 1000),
            'specifications' => $this->faker->text(),
//            'description' => $this->faker->text(),
//            'instructions' => $this->faker->text(),
//            'powerRating' => rand(100, 1000),
            'formFactor' => $this->faker->title(),
//            'voltageRating' => $this->faker->title(),
            'datasheetURL' => $this->faker->title(),
            'price' => rand(100, 1000),
            'thumb' => NULL,
            'consumable_type_id' => $this->faker->randomElement(['11', '30'])
        ];
    }
}
