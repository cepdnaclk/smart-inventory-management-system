<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Database\Seeders\Traits\TruncateTable;

/**
 * Class DatabaseSeeder.
 */
class DatabaseSeeder extends Seeder
{
    use TruncateTable;

    /**
     * Seed the application's database.
     */
    public function run()
    {
        Model::unguard();

        $this->truncateMultiple([
            'activity_log',
            'failed_jobs',
        ]);

        $this->call(AuthSeeder::class);
        $this->call(AnnouncementSeeder::class);

        $this->call(EquipmentTypeSeeder::class);
        $this->call(EquipmentItemSeeder::class);
        $this->call(ComponentTypeSeeder::class);
        $this->call(ComponentItemSeeder::class);

        $this->call(RawMaterialsSeeder::class);
        $this->call(MachinesSeeder::class);
        $this->call(JobRequestsSeeder::class);

        $this->call(ReservationsSeeder::class);


        Model::reguard();
    }
}
