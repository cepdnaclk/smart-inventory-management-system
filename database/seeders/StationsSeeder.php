<?php

namespace Database\Seeders;

use App\Models\Stations;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StationsSeeder extends Seeder
{

    protected $data = [
        array('id' => '1', 'stationName' => 'Measuring Station A', 'description' => 'This measuring station can be used to do the measurements with electronic instruments such as Oscilloscopes, Signal Generators, etc... They also can do some prototyping works with breadboards in here', 'thumb' => '1657218108.jpg', 'capacity' => '3', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2022-07-07 18:21:48'),
        array('id' => '2', 'stationName' => 'Measuring Station B', 'description' => 'This measuring station can be used to do the measurements with electronic instruments such as Oscilloscopes, Signal Generators, etc... They also can do some prototyping works with breadboards in here', 'thumb' => '1657218135.jpg', 'capacity' => '3', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2022-07-07 18:22:15'),
        array('id' => '3', 'stationName' => 'Soldering Station', 'description' => 'Students can use this Soldering Station for doing soldering, desoldering and testing the PCBs.', 'thumb' => '1657218148.jpg', 'capacity' => '3', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2022-07-07 18:22:28'),
        array('id' => '4', 'stationName' => 'Assembly Station A', 'description' => 'Students can use this table to keep the materials and do basic assembly works using light tools such as screwdrivers, paper cutters, etc… Those tools will be available as a moveable tools rack', 'thumb' => '1657218165.jpg', 'capacity' => '3', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2022-07-07 18:26:23'),
        array('id' => '5', 'stationName' => 'Assembly Station B', 'description' => 'Students can use this table to keep the materials and do basic assembly works using light tools such as screwdrivers, paper cutters, etc…', 'thumb' => '1657218403.jpg', 'capacity' => '1', 'created_at' => '2022-07-07 18:26:43', 'updated_at' => '2022-07-07 18:26:43')
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
        foreach (Stations::all() as $station) {
            $station->equipment_items()->attach(1000);
        }

        $this->command->info('Inserted ' . count($this->data) . ' records to Stations table');
    }
}
