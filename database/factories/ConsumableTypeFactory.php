<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ConsumableTypeFactory extends Factory
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
            'parent_id' => NULL,
            'title' => $this->faker->title(),
            'subtitle' => $this->faker->title(),
            'description' => $this->faker->paragraph(),
            'thumb' => NULL
        ];
    }
}
