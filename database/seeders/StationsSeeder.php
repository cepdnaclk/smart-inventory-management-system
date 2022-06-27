<?php

namespace Database\Seeders;

use App\Models\Stations;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StationsSeeder extends Seeder
{

    protected $data = [
    
        array('id' => '1', 'stationName' => 'Measuring station', 'description' => 'This measuring station can be used to do the measurements with electronic instruments such as Oscilloscopes, Signal Generators, etc... They also can do some prototyping works with breadboards in here','thumb' => '123.jpg',  'capacity'=> '3', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-08-04 15:25:03'),
        array('id' => '2', 'stationName' => 'Soldering station', 'description' => 'Students can use this Soldering Station for doing soldering, desoldering and testing the PCBs.','thumb' => '126.jpg',  'capacity'=> '3', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-08-04 15:25:03'),
        array('id' => '3', 'stationName' => 'Assembly station', 'description' => 'Students can use this table to keep the materials and do basic assembly works using light tools such as screwdrivers, paper cutters, etc… Those tools will be available as a moveable tools rack (under development)','thumb' => '127.jpg',  'capacity'=> '3', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-08-04 15:25:03'),
        array('id' => '4', 'stationName' => 'Drawer Rack', 'description' => 'Keep all the sensors, modules and electronic components in well organized way. This should be managed by the Technical Officer, while keeping the records of inventory.','thumb' => '124.jpg',  'capacity'=> '3', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-08-04 15:25:03'),
        array('id' => '5', 'stationName' => '3D Printer Station', 'description' => 'This station will contain 3 x 3D Printers, with the maintaining materials and 3d printer fillaments,','thumb' => '125.jpg',  'capacity'=> '3', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-08-04 15:25:03'),
        
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
