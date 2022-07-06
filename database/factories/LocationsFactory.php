<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LocationsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'location'=>$this->$faker->name(),
            'parent_location'=>'0',
            'x'=>$this->$faker->numberBetween(1,100),
            'y'=>$this->$faker->numberBetween(1,100),
            'z'=>$this->$faker->numberBetween(1,100)
        ];
    }
}
