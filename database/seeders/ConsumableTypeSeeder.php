<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConsumableTypeSeeder extends Seeder
{
    protected $data = [
        array('id' => '11', 'parent_id' => NULL, 'code' => '', 'title' => 'Resistors', 'subtitle' => '', 'description' => 'Various types of resistors', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03'),
        array('id' => '12', 'parent_id' => 11, 'code' => '', 'title' => 'THD Resistors', 'subtitle' => '', 'description' => 'Through-hole resistors', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03'),
        array('id' => '13', 'parent_id' => 11, 'code' => '', 'title' => 'SMD Resistors', 'subtitle' => '', 'description' => 'Surface-mount resistors', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03'),
        array('id' => '14', 'parent_id' => NULL, 'code' => '', 'title' => 'Capacitors', 'subtitle' => '', 'description' => 'Various types of capacitors', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03'),
        array('id' => '15', 'parent_id' => 14, 'code' => '', 'title' => 'Electrolytic Capacitors', 'subtitle' => '', 'description' => 'Electrolyte capacitors of various sizes', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03'),
        array('id' => '16', 'parent_id' => 14, 'code' => '', 'title' => 'Ceramic Capacitors', 'subtitle' => '', 'description' => 'Ceramic capacitors of various sizes', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03'),
        array('id' => '17', 'parent_id' => 14, 'code' => '', 'title' => 'SMD Capacitors', 'subtitle' => '', 'description' => 'Surface-mount capacitors', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03'),
        array('id' => '18', 'parent_id' => NULL, 'code' => '', 'title' => 'Diodes', 'subtitle' => '', 'description' => 'Various types of diodes', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03'),
        array('id' => '19', 'parent_id' => 18, 'code' => '', 'title' => 'Schottky Diodes', 'subtitle' => '', 'description' => 'Various sizes of schottky Diodes', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03'),
        array('id' => '20', 'parent_id' => 18, 'code' => '', 'title' => 'Zener Diodes', 'subtitle' => '', 'description' => 'Various sizes of zener Diodes', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03'),
        array('id' => '21', 'parent_id' => 18, 'code' => '', 'title' => 'Zener Diodes', 'subtitle' => '', 'description' => 'Various sizes of zener Diodes', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03'),
        array('id' => '22', 'parent_id' => NULL, 'code' => '', 'title' => 'Headers', 'subtitle' => '', 'description' => 'Used to connect with dot boards with arduino like devices', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03'),
        array('id' => '23', 'parent_id' => NULL, 'code' => '', 'title' => 'LEDs', 'subtitle' => '', 'description' => 'Light Emitting Diodes', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03'),
        array('id' => '24', 'parent_id' => NULL, 'code' => '', 'title' => 'Diffused LEDs', 'subtitle' => '', 'description' => 'Diffused Light Emitting Diodes', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03'),
        array('id' => '25', 'parent_id' => NULL, 'code' => '', 'title' => 'IC Bases', 'subtitle' => '', 'description' => 'Used to connect ICs to dot boards', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03'),
        array('id' => '26', 'parent_id' => NULL, 'code' => '', 'title' => 'Wires', 'subtitle' => '', 'description' => 'Used to connect ICs to dot boards', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03'),
        array('id' => '27', 'parent_id' => 26, 'code' => '', 'title' => 'Single-core wires', 'subtitle' => '', 'description' => 'Wires that have a single core', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03'),
        array('id' => '28', 'parent_id' => 26, 'code' => '', 'title' => 'Auto wires', 'subtitle' => '', 'description' => 'Wires that have a multiple cores', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03'),
        array('id' => '29', 'parent_id' => 26, 'code' => '', 'title' => 'Circuit wires', 'subtitle' => '', 'description' => 'I donno', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03'),
        array('id' => '30', 'parent_id' => NULL, 'code' => '', 'title' => 'ICs', 'subtitle' => '', 'description' => 'Integrated Circuits', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03'),
        array('id' => '31', 'parent_id' => 30, 'code' => '', 'title' => 'Logic ICs', 'subtitle' => '', 'description' => 'Logic Integrated Circuits (Logic gates)', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03'),
        array('id' => '32', 'parent_id' => 30, 'code' => '', 'title' => '74 Series ICs', 'subtitle' => '', 'description' => '74 Series Integrated Circuits', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03'),
        array('id' => '33', 'parent_id' => 30, 'code' => '', 'title' => 'Other ICs', 'subtitle' => '', 'description' => '74 Series Integrated Circuits', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03'),
        array('id' => '34', 'parent_id' => 30, 'code' => '', 'title' => 'Power Regulators', 'subtitle' => '', 'description' => 'Voltage regulators like 7805', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03'),
        array('id' => '35', 'parent_id' => NULL, 'code' => '', 'title' => 'Transistors', 'subtitle' => '', 'description' => 'Various types of transistors', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03'),
        array('id' => '36', 'parent_id' => NULL, 'code' => '', 'title' => 'Crystal Oscillators', 'subtitle' => '', 'description' => 'I donno', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03'),
        array('id' => '37', 'parent_id' => NULL, 'code' => '', 'title' => 'Switches', 'subtitle' => '', 'description' => 'Various kinds of switches', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03'),
        array('id' => '38', 'parent_id' => 37, 'code' => '', 'title' => 'DIP Switches', 'subtitle' => '', 'description' => 'Various kinds of switches', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03'),
        array('id' => '39', 'parent_id' => NULL, 'code' => '', 'title' => 'Ports', 'subtitle' => '', 'description' => 'USB ports etc..', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03'),
        array('id' => '40', 'parent_id' => NULL, 'code' => '', 'title' => 'Trimmer Potentiometers', 'subtitle' => '', 'description' => 'Variable resistors / voltage dividers', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03'),
        array('id' => '41', 'parent_id' => NULL, 'code' => '', 'title' => 'PCB Terminal', 'subtitle' => '', 'description' => 'Used to connect wires to dot board', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03'),
        array('id' => '42', 'parent_id' => NULL, 'code' => '', 'title' => 'Screw connectors', 'subtitle' => '', 'description' => 'Used to connect 2 or more wires together', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03'),
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->data as $index => $value) {
            $result = DB::table('consumable_types')->insert($value);

            if (!$result) {
                $this->command->info("Insert failed at record $index.");
                return;
            }
        }
        $this->command->info('Inserted ' . count($this->data) . ' records to consumable_types table');
    }
}
