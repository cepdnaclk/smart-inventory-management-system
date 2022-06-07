<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConsumableItemSeeder extends Seeder
{
    protected $data = [

        array('id' => '1001', 'code' => '', 'title' => '1 ohm Resistor', 'quantity' => '10', 'specifications' => 'ATMega328p Microcontroller', 'description' => 'The Arduino Uno is an open-source microcontroller board based on the Microchip ATmega328P microcontroller and developed by Arduino.cc. The board is equipped with sets of digital and analog input/output (I/O) pins that may be interfaced to various expansion boards (shields) and other circuits.', 'instructions' => NULL, 'powerRating' => '1W', 'formFactor' => 'DIP-8', 'voltageRating' => "25V", 'datasheetURL' => 'https://google.lk', 'price' => '1200.00', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'consumable_type_id' => '16'),
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->data as $index => $setting) {
            $result = DB::table('consumable_items')->insert($setting);

            if (!$result) {
                $this->command->info("Insert failed at record $index.");
                return;
            }
        }

        $this->command->info('Inserted ' . count($this->data) . ' records to consumable_items table');
    }
}
