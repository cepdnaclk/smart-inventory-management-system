<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComponentTypeSeeder extends Seeder
{
    protected $data = [
        array('id' => '10', 'parent_id' => NULL, 'title' => 'Developemnt Boards', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '11', 'parent_id' => '10', 'title' => 'Arduino', 'subtitle' => NULL, 'description' => 'Arduino based development boards', 'thumb' => NULL),
        array('id' => '12', 'parent_id' => '10', 'title' => 'Espressif', 'subtitle' => NULL, 'description' => 'ESP development boards', 'thumb' => NULL),
        array('id' => '13', 'parent_id' => '10', 'title' => 'STM', 'subtitle' => NULL, 'description' => 'STM famility development boards', 'thumb' => NULL),
        array('id' => '14', 'parent_id' => '10', 'title' => 'Raspberry Pi', 'subtitle' => NULL, 'description' => 'Raspberry Pi based development boards', 'thumb' => NULL),
        array('id' => '15', 'parent_id' => '10', 'title' => 'PIC', 'subtitle' => NULL, 'description' => 'PIC family development boards', 'thumb' => NULL),
        array('id' => '20', 'parent_id' => NULL, 'title' => 'Sensors', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '21', 'parent_id' => '20', 'title' => 'Voltage', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '22', 'parent_id' => '20', 'title' => 'Current', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '23', 'parent_id' => '20', 'title' => 'Light and Color', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '24', 'parent_id' => '20', 'title' => 'GPS', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '25', 'parent_id' => '20', 'title' => 'Pressure', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '26', 'parent_id' => '20', 'title' => 'Temperature and Humidity', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '27', 'parent_id' => '20', 'title' => 'Distance', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '28', 'parent_id' => '20', 'title' => 'Motion', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '29', 'parent_id' => '20', 'title' => 'RFID', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '30', 'parent_id' => '20', 'title' => 'Touch', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '31', 'parent_id' => '20', 'title' => 'Gas', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '32', 'parent_id' => '20', 'title' => 'Fingerprint', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '40', 'parent_id' => NULL, 'title' => 'Motor Drivers', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '41', 'parent_id' => '40', 'title' => 'DC Motor Drivers', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '42', 'parent_id' => '40', 'title' => 'Stepper Motor Drivers', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '43', 'parent_id' => '40', 'title' => 'Brushless Motor Drivers', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '50', 'parent_id' => NULL, 'title' => 'Transmiters and Receivers', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '51', 'parent_id' => '50', 'title' => 'RF', 'subtitle' => 'Radio Frequency', 'description' => NULL, 'thumb' => NULL),
        array('id' => '52', 'parent_id' => '50', 'title' => 'Bluetooth', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '53', 'parent_id' => '50', 'title' => 'WiFi', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '54', 'parent_id' => '50', 'title' => 'GSM', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '60', 'parent_id' => NULL, 'title' => 'Readers and Converters', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '61', 'parent_id' => '60', 'title' => 'MicroSD', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '62', 'parent_id' => '60', 'title' => 'USB to TTL', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '63', 'parent_id' => '60', 'title' => 'RS232 to TTL', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '70', 'parent_id' => NULL, 'title' => 'Cameras', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '71', 'parent_id' => '70', 'title' => 'RPi Camera', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '80', 'parent_id' => NULL, 'title' => 'Arduino Shields', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '90', 'parent_id' => NULL, 'title' => 'Displays', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '91', 'parent_id' => '90', 'title' => 'LCD', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '92', 'parent_id' => '90', 'title' => 'OLED', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '93', 'parent_id' => '90', 'title' => 'LED', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '94', 'parent_id' => '90', 'title' => 'TFT', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '100', 'parent_id' => NULL, 'title' => 'Output Modules', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '101', 'parent_id' => '100', 'title' => 'Speakers', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '102', 'parent_id' => '100', 'title' => 'Relays', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '110', 'parent_id' => NULL, 'title' => 'Input Modules', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '111', 'parent_id' => '110', 'title' => 'Switches', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '112', 'parent_id' => '110', 'title' => 'Matrix Keypad', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '120', 'parent_id' => NULL, 'title' => 'Expansions and Cables', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '130', 'parent_id' => NULL, 'title' => 'Motors', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '131', 'parent_id' => '130', 'title' => 'DC Non-Geared', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '132', 'parent_id' => '130', 'title' => 'DC Geared', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '133', 'parent_id' => '130', 'title' => 'Stepper', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '134', 'parent_id' => '130', 'title' => 'Servo', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '135', 'parent_id' => '130', 'title' => 'Brushless', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '136', 'parent_id' => '130', 'title' => 'AC', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '140', 'parent_id' => NULL, 'title' => 'Measuring', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '141', 'parent_id' => '140', 'title' => 'Multimeters', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '142', 'parent_id' => '140', 'title' => 'Logic Probes', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '150', 'parent_id' => NULL, 'title' => 'ICs', 'subtitle' => 'Integrated Circuits', 'description' => NULL, 'thumb' => NULL),
        array('id' => '151', 'parent_id' => '150', 'title' => 'Digital Logic', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '152', 'parent_id' => '150', 'title' => 'Amplifiers', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL),
        array('id' => '153', 'parent_id' => '150', 'title' => 'Memory', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL)
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->data as $index => $value) {
            $result = DB::table('component_types')->insert($value);

            if (!$result) {
                $this->command->info("Insert failed at record $index.");
                return;
            }
        }
        $this->command->info('Inserted ' . count($this->data) . ' records to component_types table');
    }
}