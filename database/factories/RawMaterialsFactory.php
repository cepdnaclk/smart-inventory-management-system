<?php

namespace Database\Factories;

use App\Models\RawMaterials;
use Illuminate\Database\Eloquent\Factories\Factory;

class RawMaterialsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RawMaterials::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $availabilityOptions = RawMaterials::availabilityOptions();
        return [
            'title' => $this->faker->name,
            'color' => "red",
            'specifications' => $this->faker->text(),
            'description' => $this->faker->text(),
            'quantity' => rand(1, 10),
            'unit' => 'pcs',
            'availability' => array_rand($availabilityOptions),
        ];
    }
}
