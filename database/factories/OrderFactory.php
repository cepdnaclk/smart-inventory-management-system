<?php

namespace Database\Factories;

use App\Models\Order;
use App\Domains\Auth\Models\User;
use App\Models\Locker;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ordered_date' =>  $this->faker->date(),
            'picked_date' => NULL,
            'due_date_to_return' => $this->faker->date(),
            'returned_date' => NULL,
            'user_id' => User::all()->random()->id,
            'locker_id' => rand(1, 24),
            // 'locker_id' => Locker::all()->random()->id,
            'status' => $this->faker->randomElement(['WAITING_LECTURER_APPROVAL', 'WAITING_H_O_D_APPROVAL', 'APPROVED', 'READY', 'PICKED', 'SUBMITTED', 'FINISHED'])
        ];
    }
}
