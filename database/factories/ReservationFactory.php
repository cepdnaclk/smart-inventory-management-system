<?php

namespace Database\Factories;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reservation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->randomElement(['1','5']),
            'start_date' => $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
            'end_date' => $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
            'station_id' => $this->faker->randomElement(['1','5']),
            'E_numbers' => 'E/18/147, E/18/242, E/18/379',
            'duration' => $this->faker->randomElement(['30','240']),

        ];
    }
}
