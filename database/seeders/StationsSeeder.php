<?php

namespace Database\Seeders;

use App\Models\Stations;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StationsSeeder extends Seeder
{

    protected $data = [
    
        array('id' => '1', 'stationName' => 'Measuring station', 'description' => '','thumb' => '1629197752.jpg',  'capacity'=> '3', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-08-04 15:25:03'),
        array('id' => '2', 'stationName' => 'Soldering station', 'description' => '','thumb' => '',  'capacity'=> '3', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-08-04 15:25:03'),
        array('id' => '3', 'stationName' => 'Assembly station', 'description' => '','thumb' => '',  'capacity'=> '3', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-08-04 15:25:03'),
        
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

        //example to add equipment to station
        foreach (Stations::all() as $station){
            $station->equipment_items()->attach(1000);
        }

        $this->command->info('Inserted ' . count($this->data) . ' records to reservations table');
    }
}
