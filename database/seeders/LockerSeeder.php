<?php

namespace Database\Seeders;

use App\Models\Locker;
use Illuminate\Database\Seeder;
use Database\Seeders\Traits\DisableForeignKeys;

class LockerSeeder extends Seeder
{
    use DisableForeignKeys;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Locker::factory()->times(50)->create();
        $this->disableForeignKeys();

        Locker::factory()
            ->count(50)
            ->create();

        $this->enableForeignKeys();
    }
}
