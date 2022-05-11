<?php

namespace Database\Factories;

use App\Models\Machines;
use Illuminate\Database\Eloquent\Factories\Factory;

class MachinesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Machines::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $availabilityOptions = Machines::availabilityOptions();
        $types = Machines::types();

        return [
            'title' => $this->faker->name,
            'type' => array_rand($types),
            'build_width' => rand(10, 100),
            'build_length' => rand(10, 100),
            'build_height' => rand(10, 100),
            'power' => rand(30, 100),
            'thumb' => NULL,
            'specifications' => $this->faker->text(),
            'status' => array_rand($availabilityOptions),
            'notes' => $this->faker->text(),
            'lifespan' => rand(10, 3000)
        ];
    }
}
