<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemLocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $data = [

        array('id' => '0',  'location_id' => 2, 'item_id' => "EQ/19/1023"),
        array('id' => '1',  'location_id' => 1 , 'item_id' => "EQ/17/1038"),


    ];
    public function run()
    {
        foreach ($this->data as $index => $setting) {
            $result = DB::table('item_locations')->insert($setting);

            if (!$result) {
                $this->command->info("Insert failed at record $index.");
                return;
            }
        }

        $this->command->info('Inserted ' . count($this->data) . ' records to item_locations table');

        
    }
}
