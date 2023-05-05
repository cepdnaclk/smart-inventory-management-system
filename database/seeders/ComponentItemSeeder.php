<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComponentItemSeeder extends Seeder
{
    protected $data = [


        array('id' => '1001', 'code' => '', 'title' => 'Arduino UNO REV3', 'brand' => 'Arduino', 'productCode' => 'Uno v3', 'quantity' => '10', 'specifications' => 'ATMega328p Microcontroller', 'description' => 'The Arduino Uno is an open-source microcontroller board based on the Microchip ATmega328P microcontroller and developed by Arduino.cc. The board is equipped with sets of digital and analog input/output (I/O) pins that may be interfaced to various expansion boards (shields) and other circuits.', 'instructions' => NULL, 'isAvailable' => '1', 'isElectrical' => '1', 'powerRating' => NULL, 'price' => '1200.00', 'thumb' => 'arduino_uno_REV3.jpg', 'size' => 'medium', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'component_type_id' => '16'),
        array('id' => '1002', 'code' => '', 'title' => '741 Operational Amplifier', 'brand' => NULL, 'productCode' => NULL, 'quantity' => '50', 'specifications' => 'UA741CP OpAmp 1MHz', 'description' => 'The 741 Op Amp IC is a monolithic integrated circuit, comprising of a general purpose Operational Amplifier.', 'instructions' => NULL, 'isAvailable' => '1', 'isElectrical' => '1', 'powerRating' => NULL, 'price' => '80.00', 'thumb' => '741CN_opamp.jpg', 'size' => 'small', 'created_at' => '2021-08-04 15:26:56', 'updated_at' => '2021-09-02 05:42:11', 'component_type_id' => '17'),
        array('id' => '1003', 'code' => '', 'title' => 'Altera DE2-115', 'brand' => NULL, 'productCode' => NULL, 'quantity' => '10', 'specifications' => '', 'description' => 'The DE2 series has consistently been at the forefront of educational development boards by distinguishing itself with an abundance of interfaces to accommodate various application needs.', 'instructions' => NULL, 'isAvailable' => '1', 'isElectrical' => NULL, 'powerRating' => NULL, 'price' => '1200.00', 'thumb' => 'Altera DE2-115.jpg', 'size' => 'medium', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'component_type_id' => '16'),
        array('id' => '1004', 'code' => '', 'title' => 'Raspberry Pi Pico', 'brand' => NULL, 'productCode' => NULL, 'quantity' => '10', 'specifications' => '', 'description' => 'Raspberry Pi Pico is the first microcontroller from the manufacturers of Raspberry Pi, based on the Raspberry Pi’s RP2040 microcontroller chip.', 'instructions' => NULL, 'isAvailable' => '1', 'isElectrical' => NULL, 'powerRating' => NULL, 'price' => '1200.00', 'thumb' => 'raspberry_pi_pico.jpg', 'size' => 'medium', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'component_type_id' => '16'),
        array('id' => '1005', 'code' => '', 'title' => 'Arduino Nano', 'brand' => NULL, 'productCode' => NULL, 'quantity' => '20', 'specifications' => '', 'description' => 'The Arduino Nano is another popular Arduino development board very much similar to the Arduino UNO. They use the same Processor (Atmega328p) and hence they both can share the same program.', 'instructions' => NULL, 'isAvailable' => '1', 'isElectrical' => NULL, 'powerRating' => NULL, 'price' => '1200.00', 'thumb' => 'arduino_nano_v3.jpg', 'size' => 'medium', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'component_type_id' => '16'),
        array('id' => '1006', 'code' => '', 'title' => 'NodeMCU esp8266', 'brand' => NULL, 'productCode' => NULL, 'quantity' => '20', 'specifications' => '', 'description' => 'NodeMCU is an open-source Lua based firmware and development board specially targeted for IoT based Applications. It includes firmware that runs on the ESP8266 Wi-Fi SoC from Espressif Systems, and hardware which is based on the ESP-12 module.', 'instructions' => NULL, 'isAvailable' => '1', 'isElectrical' => NULL, 'powerRating' => NULL, 'price' => '1200.00', 'thumb' => 'nodeemu.jpg', 'size' => 'medium', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'component_type_id' => '16'),
        array('id' => '1007', 'code' => '', 'title' => '741 Operational Amplifier', 'brand' => NULL, 'productCode' => NULL, 'quantity' => '50', 'specifications' => 'UA741CP OpAmp 1MHz', 'description' => 'The 741 Op Amp IC is a monolithic integrated circuit, comprising of a general purpose Operational Amplifier.', 'instructions' => NULL, 'isAvailable' => '1', 'isElectrical' => '1', 'powerRating' => NULL, 'price' => '80.00', 'thumb' => '741CN_opamp.jpg', 'size' => 'small', 'created_at' => '2021-08-04 15:26:56', 'updated_at' => '2021-09-02 05:42:11', 'component_type_id' => '17'),
        array('id' => '1008', 'code' => '', 'title' => 'LM393', 'brand' => NULL, 'productCode' => NULL, 'quantity' => '50', 'specifications' => 'UA741CP OpAmp 1MHz', 'description' => 'LM393 is a IC with a dual comparator in a single IC package. The dual independent voltage comparator in this IC is capable of single or split supply operation. LM393 has the input voltage range of 2V – 36V. The dual comparator feature of this IC enhances high gain and wide bandwidth characteristics. LM393 has an input offset voltage of 2mV. This IC can be used in voltage comparator circuits, electronic oscillator, and timer circuit.', 'instructions' => NULL, 'isAvailable' => '1', 'isElectrical' => '1', 'powerRating' => NULL, 'price' => '80.00', 'thumb' => 'lm393.jpg', 'size' => 'small', 'created_at' => '2021-08-04 15:26:56', 'updated_at' => '2021-09-02 05:42:11', 'component_type_id' => '17'),


        array('id' => '1011', 'code' => '', 'title' => '1602 16x2 LCD Keypad Shield Module for Arduino', 'brand' => 'Arduino', 'productCode' => 'Uno v3', 'quantity' => '10', 'specifications' => 'ATMega328p Microcontroller', 'description' => 'The Arduino Uno is an open-source microcontroller board based on the Microchip ATmega328P microcontroller and developed by Arduino.cc. The board is equipped with sets of digital and analog input/output (I/O) pins that may be interfaced to various expansion boards (shields) and other circuits.', 'instructions' => NULL, 'isAvailable' => '1', 'isElectrical' => '1', 'powerRating' => NULL, 'price' => '1200.00', 'thumb' => 'comit 1008.jpeg', 'size' => 'medium', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'component_type_id' => '16'),
        array('id' => '1012', 'code' => '', 'title' => ' 0.33uF 50V Electrolytic Capacitor THT (CA0076)', 'brand' => NULL, 'productCode' => NULL, 'quantity' => '50', 'specifications' => 'UA741CP OpAmp 1MHz', 'description' => 'The 741 Op Amp IC is a monolithic integrated circuit, comprising of a general purpose Operational Amplifier.', 'instructions' => NULL, 'isAvailable' => '1', 'isElectrical' => '1', 'powerRating' => NULL, 'price' => '80.00', 'thumb' => 'comit 1009.jpeg', 'size' => 'small', 'created_at' => '2021-08-04 15:26:56', 'updated_at' => '2021-09-02 05:42:11', 'component_type_id' => '17'),
        array('id' => '1013', 'code' => '', 'title' => '2-Wheel Round Double Deck Smart Car Chassis Kit', 'brand' => NULL, 'productCode' => NULL, 'quantity' => '50', 'specifications' => 'Package', 'description' => '2 Wheel round smart robot car 1 x Round Acrylic Plate
        1 x Acrylic Baseboard 2 x 65mm Wheel
        2 x Universal Wheel 2 x Gear Motor', 'instructions' => NULL, 'isAvailable' => '1', 'isElectrical' => '1', 'powerRating' => NULL, 'price' => '80.00', 'thumb' => 'comit 1005.jpeg', 'size' => 'small', 'created_at' => '2021-08-04 15:26:56', 'updated_at' => '2021-09-02 05:42:11', 'component_type_id' => '17'),

        array('id' => '1014', 'code' => '', 'title' => '0.22ohm 5W Resistor Wire Wound Ceramic THT 5%', 'brand' => NULL, 'productCode' => NULL, 'quantity' => '50', 'specifications' => 'UA741CP OpAmp 1MHz', 'description' => 'The 741 Op Amp IC is a monolithic integrated circuit, comprising of a general purpose Operational Amplifier.', 'instructions' => NULL, 'isAvailable' => '1', 'isElectrical' => '1', 'powerRating' => NULL, 'price' => '80.00', 'thumb' => 'comit 1006.jpeg', 'size' => 'small', 'created_at' => '2021-08-04 15:26:56', 'updated_at' => '2021-09-02 05:42:11', 'component_type_id' => '17'),
        array('id' => '1015', 'code' => '', 'title' => '1-Digit 7-Segment Green Colour 3 inch Common', 'brand' => NULL, 'productCode' => NULL, 'quantity' => '50', 'specifications' => 'UA741CP OpAmp 1MHz', 'description' => 'The 741 Op Amp IC is a monolithic integrated circuit, comprising of a general purpose Operational Amplifier.', 'instructions' => NULL, 'isAvailable' => '1', 'isElectrical' => '1', 'powerRating' => NULL, 'price' => '80.00', 'thumb' => 'comit 1007.png', 'size' => 'small', 'created_at' => '2021-08-04 15:26:56', 'updated_at' => '2021-09-02 05:42:11', 'component_type_id' => '17'),
        array('id' => '1016', 'code' => '', 'title' => ' 1.8M 1W Resistor Pack Carbon Film THT 5%', 'brand' => 'Arduino', 'productCode' => 'Uno v3', 'quantity' => '10', 'specifications' => 'ATMega328p Microcontroller', 'description' => 'The Arduino Uno is an open-source microcontroller board based on the Microchip ATmega328P microcontroller and developed by Arduino.cc. The board is equipped with sets of digital and analog input/output (I/O) pins that may be interfaced to various expansion boards (shields) and other circuits.', 'instructions' => NULL, 'isAvailable' => '1', 'isElectrical' => '1', 'powerRating' => NULL, 'price' => '1200.00', 'thumb' => 'comit 1010.jpeg', 'size' => 'medium', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'component_type_id' => '16'),
        array('id' => '1017', 'code' => '', 'title' => ' 0.96 inch 128X64 OLED Display Module I2C IIC ', 'brand' => 'Arduino', 'productCode' => 'Uno v3', 'quantity' => '10', 'specifications' => 'ATMega328p Microcontroller', 'description' => 'The Arduino Uno is an open-source microcontroller board based on the Microchip ATmega328P microcontroller and developed by Arduino.cc. The board is equipped with sets of digital and analog input/output (I/O) pins that may be interfaced to various expansion boards (shields) and other circuits.', 'instructions' => NULL, 'isAvailable' => '1', 'isElectrical' => '1', 'powerRating' => NULL, 'price' => '1200.00', 'thumb' => 'comit 1011.png', 'size' => 'medium', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'component_type_id' => '16'),
        array('id' => '1018', 'code' => '', 'title' => ' Zener Diode 9.1V 1/2W THT (DI0201)   ', 'brand' => 'Arduino', 'productCode' => 'Uno v3', 'quantity' => '10', 'specifications' => 'ATMega328p Microcontroller', 'description' => 'The Arduino Uno is an open-source microcontroller board based on the Microchip ATmega328P microcontroller and developed by Arduino.cc. The board is equipped with sets of digital and analog input/output (I/O) pins that may be interfaced to various expansion boards (shields) and other circuits.', 'instructions' => NULL, 'isAvailable' => '1', 'isElectrical' => '1', 'powerRating' => NULL, 'price' => '1200.00', 'thumb' => 'comit 1012.png', 'size' => 'medium', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'component_type_id' => '16'),



    ];

    /**
     * Run the database seeds.
     *gh
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
