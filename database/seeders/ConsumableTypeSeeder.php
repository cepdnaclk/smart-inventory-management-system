<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConsumableTypeSeeder extends Seeder
{
    protected $data = [
        array('id' => '11', 'parent_id' => NULL, 'code' => '', 'title' => 'Resistors', 'subtitle' => '', 'description' => 'Various types of resistors', 'thumb' => NULL, 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03'),
        array('id' => '12', 'parent_id' => '11', 'code' => '', 'title' => 'Through Hole Resistors (1/4W)', 'subtitle' => NULL, 'description' => 'Through-hole resistors', 'thumb' => '1656727479.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2022-07-02 02:04:53'),
        array('id' => '13', 'parent_id' => '11', 'code' => '', 'title' => 'SMD Resistors (1206)', 'subtitle' => NULL, 'description' => 'Surface-mount Resistors, with the form factor of 1206', 'thumb' => '1656727431.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2022-07-02 02:03:51'),
        array('id' => '14', 'parent_id' => NULL, 'code' => '', 'title' => 'Capacitors', 'subtitle' => '', 'description' => 'Various types of capacitors', 'thumb' => NULL, 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03'),
        array('id' => '15', 'parent_id' => '14', 'code' => '', 'title' => 'Electrolytic Capacitors (16V)', 'subtitle' => NULL, 'description' => '16V Electrolyte capacitors', 'thumb' => '1656727560.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2022-07-02 02:06:00'),
        array('id' => '16', 'parent_id' => '14', 'code' => '', 'title' => 'Ceramic Capacitors', 'subtitle' => NULL, 'description' => 'Ceramic capacitors of various values', 'thumb' => '1656727604.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2022-07-02 02:06:44'),
        array('id' => '17', 'parent_id' => '14', 'code' => '', 'title' => 'SMD Capacitors (1206)', 'subtitle' => NULL, 'description' => 'Surface-mount capacitors of the form factor 1206', 'thumb' => '1656727698.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2022-07-02 02:08:18'),
        array('id' => '18', 'parent_id' => NULL, 'code' => '', 'title' => 'Diodes', 'subtitle' => '', 'description' => 'Various types of diodes', 'thumb' => NULL, 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03'),
        array('id' => '19', 'parent_id' => '18', 'code' => '', 'title' => 'Rectifier Diodes', 'subtitle' => NULL, 'description' => 'Various values of Rectifier Diodes', 'thumb' => '1656727743.png', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2022-07-02 02:09:03'),
        array('id' => '20', 'parent_id' => '18', 'code' => '', 'title' => 'Zener Diodes', 'subtitle' => NULL, 'description' => 'Various values of Zener Diodes', 'thumb' => '1656727802.png', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2022-07-02 02:10:02'),
        array('id' => '22', 'parent_id' => '43', 'code' => '', 'title' => 'Headers', 'subtitle' => NULL, 'description' => 'a form of electrical connector', 'thumb' => '1656727875.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2022-07-02 02:39:29'),
        array('id' => '23', 'parent_id' => NULL, 'code' => '', 'title' => 'LEDs', 'subtitle' => NULL, 'description' => 'Light Emitting Diodes', 'thumb' => '1656727926.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2022-07-02 02:12:06'),
        array('id' => '25', 'parent_id' => NULL, 'code' => '', 'title' => 'IC Bases', 'subtitle' => NULL, 'description' => 'Allows the user to connect the ICs with the circuits', 'thumb' => '1656728124.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2022-07-02 02:15:24'),
        array('id' => '26', 'parent_id' => NULL, 'code' => '', 'title' => 'Circuit Wires', 'subtitle' => NULL, 'description' => 'A type of conductor, a material that conducts electricity', 'thumb' => '1656728217.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2022-07-02 02:16:58'),
        array('id' => '27', 'parent_id' => '26', 'code' => '', 'title' => 'Single-core Wires', 'subtitle' => NULL, 'description' => 'Wires that have a single core', 'thumb' => '1656728275.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2022-07-02 02:17:55'),
        array('id' => '28', 'parent_id' => '26', 'code' => '', 'title' => 'Wires (14/0.30mm)', 'subtitle' => 'Auto wire', 'description' => 'Wires that have 14 cores and a cross-area of 0.30mm^2', 'thumb' => '1656728356.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2022-07-02 02:19:16'),
        array('id' => '29', 'parent_id' => '26', 'code' => '', 'title' => 'Circuit Wires', 'subtitle' => NULL, 'description' => 'An electrical wire is a type of conductor, which is a material that conducts electricity', 'thumb' => '1656728419.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2022-07-02 02:20:19'),
        array('id' => '30', 'parent_id' => NULL, 'code' => '', 'title' => 'ICs', 'subtitle' => 'Integrated Circuits', 'description' => 'An integrated circuit (IC), also called a microelectronic circuit, microchip, or chip, is an assembly of electronic components, fabricated as a single unit, in which miniaturized active devices (e.g., transistors and diodes) and passive devices (e.g., capacitors and resistors)', 'thumb' => '1656728542.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2022-07-02 02:22:22'),
        array('id' => '31', 'parent_id' => '30', 'code' => '', 'title' => 'Logic ICs', 'subtitle' => NULL, 'description' => 'Logic Integrated Circuits (Logic gates)', 'thumb' => NULL, 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2022-07-02 02:22:44'),
        array('id' => '32', 'parent_id' => '30', 'code' => '', 'title' => '74 Series ICs', 'subtitle' => '74xxx Series ICs', 'description' => '74xxx Series Integrated Circuits', 'thumb' => NULL, 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2022-07-02 02:23:23'),
        array('id' => '33', 'parent_id' => '30', 'code' => '', 'title' => 'Other ICs', 'subtitle' => NULL, 'description' => 'Integrated Circuits', 'thumb' => NULL, 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2022-07-02 02:23:36'),
        array('id' => '34', 'parent_id' => NULL, 'code' => '', 'title' => 'Voltage Regulators', 'subtitle' => NULL, 'description' => 'Voltage Regulators', 'thumb' => '1656728672.png', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2022-07-02 02:24:32'),
        array('id' => '35', 'parent_id' => NULL, 'code' => '', 'title' => 'Transistors', 'subtitle' => NULL, 'description' => 'Various types of transistors', 'thumb' => '1656728778.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2022-07-02 02:26:18'),
        array('id' => '36', 'parent_id' => NULL, 'code' => '', 'title' => 'Crystal Oscillators', 'subtitle' => NULL, 'description' => 'A crystal oscillator is an electronic oscillator that makes use of crystal as a frequency selective element to obtain an inverse piezoelectric effect', 'thumb' => '1656728855.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2022-07-02 02:27:36'),
        array('id' => '37', 'parent_id' => NULL, 'code' => '', 'title' => 'Switches', 'subtitle' => NULL, 'description' => 'Various kinds of switches', 'thumb' => '1656728991.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2022-07-02 02:29:51'),
        array('id' => '38', 'parent_id' => '37', 'code' => '', 'title' => 'DIP Switches', 'subtitle' => 'Dual Inline Packaged switches', 'description' => 'Dual Inline Packaged switches', 'thumb' => '1656729066.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2022-07-02 02:31:07'),
        array('id' => '39', 'parent_id' => NULL, 'code' => '', 'title' => 'Ports', 'subtitle' => NULL, 'description' => 'Different kinds of ports to interconnect devices', 'thumb' => '1656729184.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2022-07-02 02:33:04'),
        array('id' => '40', 'parent_id' => '11', 'code' => '', 'title' => 'Trimmer Potentiometers', 'subtitle' => 'Trim Pots', 'description' => 'Variable Resistors', 'thumb' => '1656743980.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2022-07-02 02:34:42'),
        array('id' => '41', 'parent_id' => '43', 'code' => '', 'title' => 'PCB Terminals', 'subtitle' => NULL, 'description' => 'PCB terminal blocks are modular, insulated devices that mount on printed circuit boards (PCBs) and secure two or more wires together', 'thumb' => '1656729359.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2022-07-02 02:38:55'),
        array('id' => '42', 'parent_id' => '43', 'code' => '', 'title' => 'Screw Terminals', 'subtitle' => NULL, 'description' => 'Screw connectors or screw terminals are commonly used concurrently with ring connectors, rectangular connectors, spade connectors, or bare wire', 'thumb' => NULL, 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2022-07-02 02:38:40'),
        array('id' => '43', 'parent_id' => NULL, 'code' => '', 'title' => 'Connectors', 'subtitle' => NULL, 'description' => 'Different types of connectors used to connect electronic components together', 'thumb' => NULL, 'created_at' => '2022-07-02 02:38:23', 'updated_at' => '2022-07-02 02:38:23'),
        array('id' => '44', 'parent_id' => '37', 'code' => '', 'title' => 'Toggle Switches', 'subtitle' => NULL, 'description' => 'A toggle switch is a type of electrical switch that is actuated by moving a lever back and forth to open or close an electrical circuit', 'thumb' => '1656730311.jpg', 'created_at' => '2022-07-02 02:51:51', 'updated_at' => '2022-07-02 02:51:51')
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
