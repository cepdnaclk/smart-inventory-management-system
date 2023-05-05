<?php

namespace Database\Seeders;

use App\Models\OrderApproval;
use Illuminate\Database\Seeder;

class OrderApprovalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderApproval::factory()
            ->count(10)
            ->create();
    }
}
