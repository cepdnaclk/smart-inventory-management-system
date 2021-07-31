<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EquipmentTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    protected $data = [
        array('id' => '1', 'title' => 'Hand Tools', 'subtitle' => NULL, 'description' => 'Hand Tools used in the workshop', 'thumb' => NULL, 'created_at' => NULL, 'updated_at' => '2021-07-31 18:31:13'),
        array('id' => '4', 'title' => 'Power Tools', 'subtitle' => NULL, 'description' => 'Power Tools used in the workshop', 'thumb' => NULL, 'created_at' => '2021-07-31 18:33:16', 'updated_at' => '2021-07-31 18:40:48'),
        array('id' => '5', 'title' => 'Safety Equipment', 'subtitle' => NULL, 'description' => 'Safety Equipment used in the workshop', 'thumb' => NULL, 'created_at' => '2021-07-31 18:44:54', 'updated_at' => '2021-07-31 18:44:54')
    ];

    public function run()
    {
        foreach ($this->data as $index => $setting) {
            $result = DB::table('equipment_types')->insert($setting);

            if (!$result) {
                $this->command->info("Insert failed at record $index.");

                return;
            }
        }

        $this->command->info('Inserted ' . count($this->data) . ' records.');
    }
}
