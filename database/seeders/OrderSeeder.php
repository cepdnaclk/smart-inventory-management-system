<?php

namespace Database\Seeders;

use App\Models\Order;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Domains\Auth\Models\User;


class OrderSeeder extends Seeder
{

    use DisableForeignKeys;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();

        Order::factory()
            ->count(75)
            ->hasComponentItems(5)
            ->create();


        $this->enableForeignKeys();
    }
}
