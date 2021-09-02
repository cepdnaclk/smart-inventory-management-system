<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComponentItemSeeder extends Seeder
{
    protected $data = [
        array('id' => '1001', 'code' => '', 'title' => 'Arduino UNO REV3', 'brand' => 'Arduino', 'productCode' => 'Uno v3', 'quantity' => '10', 'specifications' => 'ATMega328p Microcontroller', 'description' => 'The Arduino Uno is an open-source microcontroller board based on the Microchip ATmega328P microcontroller and developed by Arduino.cc. The board is equipped with sets of digital and analog input/output (I/O) pins that may be interfaced to various expansion boards (shields) and other circuits.', 'instructions' => NULL, 'isAvailable' => '1', 'isElectrical' => '1', 'powerRating' => NULL, 'price' => '1200.00', 'thumb' => 'comit1002.jpg', 'size' => 'medium', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'component_type_id' => '16'),
        array('id' => '1002', 'code' => '', 'title' => '741 Operational Amplifier', 'brand' => NULL, 'productCode' => NULL, 'quantity' => '50', 'specifications' => 'UA741CP OpAmp 1MHz', 'description' => 'The 741 Op Amp IC is a monolithic integrated circuit, comprising of a general purpose Operational Amplifier.', 'instructions' => NULL, 'isAvailable' => '1', 'isElectrical' => '1', 'powerRating' => NULL, 'price' => '80.00', 'thumb' => 'comit1002.jpg', 'size' => 'small', 'created_at' => '2021-08-04 15:26:56', 'updated_at' => '2021-09-02 05:42:11', 'component_type_id' => '17')
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->data as $index => $setting) {
            $result = DB::table('component_items')->insert($setting);

            if (!$result) {
                $this->command->info("Insert failed at record $index.");
                return;
            }
        }

        $this->command->info('Inserted ' . count($this->data) . ' records to component_items table');
    }
}
