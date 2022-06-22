<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StationsSeeder extends Seeder
{

    protected $data = [
    
        array('id' => '1', 'stationName' => 'measuring station', 'description' => '','thumb' => '',  'capacity'=> '3', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-08-04 15:25:03'),
        array('id' => '2', 'stationName' => 'soldering station', 'description' => '','thumb' => '',  'capacity'=> '3', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-08-04 15:25:03'),
        
          
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        foreach ($this->data as $index => $setting) {
            $result = DB::table('stations')->insert($setting);

            if (!$result) {
                $this->command->info("Insert failed at record $index.");
                return;
            }
        }

        $this->command->info('Inserted ' . count($this->data) . ' records to reservations table');
    }
}
