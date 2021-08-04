<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquipmentItemSeeder extends Seeder
{
    protected $data = [
        array('id' => '1', 'code' => '', 'title' => 'Wire Stripper', 'brand' => 'Ingco', 'specifications' => 'Cutting Size: 0.5-6mm', 'description' => 'A wire stripper is a small, hand-held device used to strip the electrical insulation from electric wires', 'instructions' => 'You can use the adjustable knob behind the tool to decide the force that should be applied to the wire', 'isElectrical' => '0', 'powerRating' => '0.00', 'price' => '1500.00', 'width' => '9.00', 'length' => '17.00', 'height' => '2.50', 'weight' => '150.00', 'thumb' => NULL, 'equipment_type_id' => '1', 'created_at' => '2021-08-04 10:49:27', 'updated_at' => '2021-08-04 16:57:13'),
        array('id' => '2', 'code' => '', 'title' => 'Digital Multimeter', 'brand' => 'ANENG-860B+', 'specifications' => 'Frequency: 1Hz to 20MHz
Temperature: -20℃ to 1000℃ (-4℉ to 1832℉)
Capacitance: 10pF to 6000uF
AC volts: 0.1mV to 750V
DC volts: 0.1mV to 1000V
AC current: 0.1uA to 20A
DC current: 0.1uA to 20A
Resistance: 0.1Ω to 60MΩ
Duty cycle: 1% to 99%', 'description' => NULL, 'instructions' => 'Digital Multimeter', 'isElectrical' => '0', 'powerRating' => '0.00', 'price' => '2000.00', 'width' => '7.00', 'length' => '13.00', 'height' => '3.50', 'weight' => '200.00', 'thumb' => NULL, 'equipment_type_id' => '5', 'created_at' => '2021-08-04 16:26:52', 'updated_at' => '2021-08-04 16:57:27')
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->data as $index => $setting) {
            $result = DB::table('equipment_items')->insert($setting);

            if (!$result) {
                $this->command->info("Insert failed at record $index.");
                return;
            }
        }

        $this->command->info('Inserted ' . count($this->data) . ' records to equipment_items table');
    }
}
