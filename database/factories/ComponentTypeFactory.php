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
            'parent_id' => NULL,
            'title' => $this->faker->name(),
            'subtitle' => $this->faker->name(),
            'description' => $this->faker->paragraph(),
            'thumb' => NULL
        ];
    }
}
