<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquipmentTypeSeeder extends Seeder
{
    protected $data = [
        array('id' => '11','title' => 'Hand Tools','subtitle' => NULL,'description' => 'Nonelectrical tools that used to make physical changes to objects.','thumb' => NULL,'created_at' => '2021-08-04 15:23:56','updated_at' => '2021-08-04 15:25:03'),
        array('id' => '12','title' => 'Power Tools','subtitle' => NULL,'description' => 'Electrical tools and machines that used to make physical changes to objects.','thumb' => NULL,'created_at' => '2021-08-04 15:24:54','updated_at' => '2021-08-04 15:24:54'),
        array('id' => '13','title' => 'Safety Equipment','subtitle' => NULL,'description' => 'Wearable equipment which are used for the protection of life and to avoid injuries.','thumb' => NULL,'created_at' => '2021-08-04 15:27:16','updated_at' => '2021-08-04 15:27:16'),
        array('id' => '14','title' => 'Soldering Tools','subtitle' => NULL,'description' => 'Tools that are related to soldering','thumb' => NULL,'created_at' => '2021-08-04 16:10:20','updated_at' => '2021-08-04 16:10:20'),
        array('id' => '15','title' => 'Measuring Instruments','subtitle' => 'Physical Measurements','description' => 'Tools that are used to take measurements','thumb' => NULL,'created_at' => '2021-08-04 16:11:20','updated_at' => '2021-08-04 16:11:35'),
        array('id' => '16','title' => 'Prototyping Machines','subtitle' => NULL,'description' => 'Machines that are used to fabricate things','thumb' => NULL,'created_at' => '2021-08-04 16:12:45','updated_at' => '2021-08-04 16:12:45')
    ];

    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        foreach ($this->data as $index => $setting) {
            $result = DB::table('equipment_types')->insert($setting);

            if (!$result) {
                $this->command->info("Insert failed at record $index.");
                return;
            }
        }

        $this->command->info('Inserted ' . count($this->data) . ' records to equipment_types table');
    }
}
