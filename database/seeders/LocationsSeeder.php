<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationsSeeder extends Seeder
{
    protected $data = [

        array('id' => '1', 'location' => 'MakerSpace', 'parent_location' => NULL, 'x' => NULL, 'y' => NULL, 'z' => NULL, 'created_at' => NULL, 'updated_at' => NULL),
        array('id' => '2', 'location' => 'Measuring Station A', 'parent_location' => '1', 'x' => NULL, 'y' => NULL, 'z' => NULL, 'created_at' => '2022-07-09 17:47:50', 'updated_at' => '2022-07-09 17:47:50'),
        array('id' => '3', 'location' => 'Measuring Station B', 'parent_location' => '1', 'x' => NULL, 'y' => NULL, 'z' => NULL, 'created_at' => '2022-07-09 17:47:59', 'updated_at' => '2022-07-09 17:47:59'),
        array('id' => '4', 'location' => 'Soldering Station', 'parent_location' => '1', 'x' => NULL, 'y' => NULL, 'z' => NULL, 'created_at' => '2022-07-09 17:48:14', 'updated_at' => '2022-07-09 17:48:14'),
        array('id' => '5', 'location' => 'Testing Station', 'parent_location' => '1', 'x' => NULL, 'y' => NULL, 'z' => NULL, 'created_at' => '2022-07-09 17:48:25', 'updated_at' => '2022-07-09 17:48:25'),
        array('id' => '6', 'location' => 'Assembling Station', 'parent_location' => '1', 'x' => NULL, 'y' => NULL, 'z' => NULL, 'created_at' => '2022-07-09 17:48:42', 'updated_at' => '2022-07-09 17:48:42'),
        array('id' => '7', 'location' => '3D Printer Station', 'parent_location' => '1', 'x' => NULL, 'y' => NULL, 'z' => NULL, 'created_at' => '2022-07-09 17:49:22', 'updated_at' => '2022-07-09 17:49:22'),
        array('id' => '8', 'location' => 'CNC Station', 'parent_location' => '1', 'x' => NULL, 'y' => NULL, 'z' => NULL, 'created_at' => '2022-07-09 17:49:35', 'updated_at' => '2022-07-09 17:49:35'),
        array('id' => '9', 'location' => 'Component Drawer Rack', 'parent_location' => '1', 'x' => NULL, 'y' => NULL, 'z' => NULL, 'created_at' => '2022-07-09 17:50:09', 'updated_at' => '2022-07-09 17:50:09'),
        array('id' => '10', 'location' => 'Machine Room', 'parent_location' => '1', 'x' => NULL, 'y' => NULL, 'z' => NULL, 'created_at' => '2022-07-09 17:49:04', 'updated_at' => '2022-07-09 17:49:04'),
        array('id' => '11', 'location' => 'Drawer Rack', 'parent_location' => '5', 'x' => NULL, 'y' => NULL, 'z' => NULL, 'created_at' => '2022-07-09 17:55:29', 'updated_at' => '2022-07-09 17:55:29'),
        array('id' => '12', 'location' => 'Wall Rack', 'parent_location' => '10', 'x' => NULL, 'y' => NULL, 'z' => NULL, 'created_at' => '2022-07-09 17:55:51', 'updated_at' => '2022-07-09 17:55:51'),
        array('id' => '13', 'location' => 'Tools Board', 'parent_location' => '10', 'x' => NULL, 'y' => NULL, 'z' => NULL, 'created_at' => '2022-07-09 17:56:10', 'updated_at' => '2022-07-09 17:56:10'),
        array('id' => '14', 'location' => 'Storage Bin Rack', 'parent_location' => '10', 'x' => NULL, 'y' => NULL, 'z' => NULL, 'created_at' => '2022-07-09 17:56:33', 'updated_at' => '2022-07-09 17:56:33'),
        array('id' => '15', 'location' => 'Power Tools Rack', 'parent_location' => '10', 'x' => NULL, 'y' => NULL, 'z' => NULL, 'created_at' => '2022-07-09 17:56:51', 'updated_at' => '2022-07-09 17:56:51'),
        array('id' => '16', 'location' => 'Safety Equipment Rack', 'parent_location' => '10', 'x' => NULL, 'y' => NULL, 'z' => NULL, 'created_at' => '2022-07-09 17:57:04', 'updated_at' => '2022-07-09 17:57:04'),
        array('id' => '17', 'location' => 'Table A', 'parent_location' => '10', 'x' => NULL, 'y' => NULL, 'z' => NULL, 'created_at' => '2022-07-09 17:57:23', 'updated_at' => '2022-07-09 17:57:23'),
        array('id' => '18', 'location' => 'Table B', 'parent_location' => '10', 'x' => NULL, 'y' => NULL, 'z' => NULL, 'created_at' => '2022-07-09 17:57:35', 'updated_at' => '2022-07-09 17:57:35'),
        array('id' => '19', 'location' => 'Drawer 01', 'parent_location' => '9', 'x' => NULL, 'y' => NULL, 'z' => NULL, 'created_at' => '2022-07-09 17:58:27', 'updated_at' => '2022-07-09 17:58:27'),
        array('id' => '20', 'location' => 'Drawer 02', 'parent_location' => '9', 'x' => NULL, 'y' => NULL, 'z' => NULL, 'created_at' => '2022-07-09 17:58:27', 'updated_at' => '2022-07-09 17:58:27'),
        array('id' => '21', 'location' => 'Drawer 03', 'parent_location' => '9', 'x' => NULL, 'y' => NULL, 'z' => NULL, 'created_at' => '2022-07-09 17:58:27', 'updated_at' => '2022-07-09 17:58:27'),
        array('id' => '22', 'location' => 'Drawer 04', 'parent_location' => '9', 'x' => NULL, 'y' => NULL, 'z' => NULL, 'created_at' => '2022-07-09 17:58:27', 'updated_at' => '2022-07-09 17:58:27'),
        array('id' => '23', 'location' => 'Drawer 05', 'parent_location' => '9', 'x' => NULL, 'y' => NULL, 'z' => NULL, 'created_at' => '2022-07-09 17:58:27', 'updated_at' => '2022-07-09 17:58:27'),
        array('id' => '24', 'location' => 'Drawer 06', 'parent_location' => '9', 'x' => NULL, 'y' => NULL, 'z' => NULL, 'created_at' => '2022-07-09 17:58:27', 'updated_at' => '2022-07-09 17:58:27'),
        array('id' => '25', 'location' => 'Drawer 07', 'parent_location' => '9', 'x' => NULL, 'y' => NULL, 'z' => NULL, 'created_at' => '2022-07-09 17:58:27', 'updated_at' => '2022-07-09 17:58:27'),
        array('id' => '26', 'location' => 'Drawer 08', 'parent_location' => '9', 'x' => NULL, 'y' => NULL, 'z' => NULL, 'created_at' => '2022-07-09 17:58:27', 'updated_at' => '2022-07-09 17:58:27'),
        array('id' => '27', 'location' => 'Drawer 09', 'parent_location' => '9', 'x' => NULL, 'y' => NULL, 'z' => NULL, 'created_at' => '2022-07-09 17:58:27', 'updated_at' => '2022-07-09 17:58:27'),
        array('id' => '28', 'location' => 'Drawer 10', 'parent_location' => '9', 'x' => NULL, 'y' => NULL, 'z' => NULL, 'created_at' => '2022-07-09 17:58:27', 'updated_at' => '2022-07-09 17:58:27'),
        array('id' => '29', 'location' => 'Drawer 11', 'parent_location' => '9', 'x' => NULL, 'y' => NULL, 'z' => NULL, 'created_at' => '2022-07-09 17:58:27', 'updated_at' => '2022-07-09 17:58:27'),
        array('id' => '30', 'location' => 'Drawer 12', 'parent_location' => '9', 'x' => NULL, 'y' => NULL, 'z' => NULL, 'created_at' => '2022-07-09 17:58:27', 'updated_at' => '2022-07-09 17:58:27'),
        array('id' => '31', 'location' => 'Half Sockets Board', 'parent_location' => '13', 'x' => NULL, 'y' => NULL, 'z' => NULL, 'created_at' => '2022-07-09 17:58:27', 'updated_at' => '2022-07-09 17:58:27'),
        array('id' => '32', 'location' => 'Screwdriver Rack', 'parent_location' => '6', 'x' => NULL, 'y' => NULL, 'z' => NULL, 'created_at' => '2022-07-09 17:58:27', 'updated_at' => '2022-07-09 17:58:27'),
        array('id' => '33', 'location' => 'Double Open Wrench kit', 'parent_location' => '6', 'x' => NULL, 'y' => NULL, 'z' => NULL, 'created_at' => '2022-07-09 17:58:27', 'updated_at' => '2022-07-09 17:58:27'),
        array('id' => '34', 'location' => 'Testing Accessories Set', 'parent_location' => '5', 'x' => NULL, 'y' => NULL, 'z' => NULL, 'created_at' => '2022-07-09 17:58:27', 'updated_at' => '2022-07-09 17:58:27'),
        array('id' => '35', 'location' => 'Power Supply Unit', 'parent_location' => '5', 'x' => NULL, 'y' => NULL, 'z' => NULL, 'created_at' => '2022-07-09 17:58:27', 'updated_at' => '2022-07-09 17:58:27'),

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
