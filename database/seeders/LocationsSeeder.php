<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationsSeeder extends Seeder
{
    protected $data = [
        array('id' => '1', 'location'=> 'Makerspace Lab', 'parent_location' => null,'x' => null, 'y' => null, 'z'=> null),
        array('id' => '2', 'location'=> 'Soldering Station Desk', 'parent_location' => 1,'x' => null, 'y' => null, 'z'=> null),
        array('id' => 3, 'location'=> 'Item Drawer', 'parent_location' => 2,'x' => null, 'y' => null, 'z'=> null),
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->data as $index => $setting) {

            $result = DB::table('locations')->insert($setting);

            if (!$result) {
                $this->command->info("Insert failed at record $index.");
                return;
            }
        }
        $this->command->info('Inserted ' . count($this->data) . ' records to locations table');
    }
}

