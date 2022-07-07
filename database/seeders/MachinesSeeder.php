<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MachinesSeeder extends Seeder
{

    protected $data = [
        array('id' => '1', 'code' => '', 'title' => 'Makerbot Replicator', 'type' => 'FDM_3D_PRINTER', 'build_width' => '300.00', 'build_length' => '200.00', 'build_height' => '165.00', 'power' => NULL, 'thumb' => '1652269372.png', 'specifications' => 'Layer Resolution: 100 microns\nMaterial Diameter: 1.75 mm\nExtruder Compatibility: Smart Extruder+', 'status' => 'AVAILABLE', 'notes' => 'Can only print with PLA', 'lifespan' => '0.00', 'created_at' => '2022-05-11 11:42:52', 'updated_at' => '2022-05-11 11:42:52'),
        array('id' => '2', 'code' => '', 'title' => 'Ender 3 Pro printer 1', 'type' => 'FDM_3D_PRINTER', 'build_width' => '300.00', 'build_length' => '300.00', 'build_height' => '400.00', 'power' => '80.00', 'thumb' => '1652269099.jpg', 'specifications' => 'Technology: FDM.\nPrint Area: 220 x 220 x 250mm.\nNozzle: 0.4mm.\nFilament: 1.75mm PLA, ABS, TPU.\nMax. Print Speed: 200mm/s.\nMax. Layer Resolution: 0.1mm.\nPrint Precision: +/-0.1mm.\nHeated Bed: Yes.', 'status' => 'NOT_AVAILABLE', 'notes' => 'Not yet received', 'lifespan' => '0.00', 'created_at' => '2022-05-11 11:38:19', 'updated_at' => '2022-05-11 11:38:19'),
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->data as $index => $setting) {
            $result = DB::table('machines')->insert($setting);

            if (!$result) {
                $this->command->info("Insert failed at record $index.");
                return;
            }
        }

        $this->command->info('Inserted ' . count($this->data) . ' records to machines table');
    }
}
