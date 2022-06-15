<?php

namespace Database\Factories;

use App\Models\JobRequests;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobRequestsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JobRequests::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $status = JobRequests::job_status();

        return [
            'student' => 2,
            'supervisor' => 3,
            'student_notes' => $this->faker->text(),
            'supervisor_notes' => $this->faker->text(),
            'other_notes' => $this->faker->text(),
            'machine' => 1,
            'material' => 1,
            'status' => array_rand($status),
            'file' => $this->faker->file(),
            'thumb' => $this->faker->file(),
            'requested_time' => $this->faker->time(),
            'approved_time' => $this->faker->time(),
            'scheduled_time' => $this->faker->time(),
            'started_time' => $this->faker->time(),
            'completed_time' => $this->faker->time(),
            'finished_time' => $this->faker->time(),
            'material_usage' => rand(10, 100),
            'machine_time' => rand(10, 100)
        ];
    }
}
