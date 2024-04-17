<?php

namespace Database\Factories;

use App\Models\EquipmentType;
use Illuminate\Database\Eloquent\Factories\Factory;

class EquipmentTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EquipmentType::class;

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
