<?php

namespace Database\Factories;

use App\Models\Locker;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class LockerFactory extends Factory
{
     /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Locker::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'notes'=>$this->faker->text(),
            'is_available'=>rand(0, 1),
        ];
    }
}
