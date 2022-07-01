<?php

namespace Database\Factories;
use App\Models\Order;
use App\Models\OrderApproval;
use App\Domains\Auth\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderApprovalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = OrderApproval::class;
    public function definition()
    {
        return [
            //
            'is_approved_by_lecturer' =>  $this->faker->boolean(),
            'is_approved_by_TO'=>$this->faker->boolean(),
            'order_id' => Order::where(['status' => 'WAITING_LECTURER_APPROVAL'||'WAITING_TECHNICAL_OFFICER_APPROVAL',
            ])->get()->random()->id,
            'lecturer_id'=>User::lecturers()->random()->id ,
            'technical_officer_id' => User::techOfficers()->random()->id ,
        ];
    }
}
