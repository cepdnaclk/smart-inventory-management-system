<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComponentTypeSeeder extends Seeder
{
    protected $data = [
        array(
            'id' => '2004',
            'code' => '', 
            'title' => 'Development boards', 
            'subtitle' => '', 
            'description' => 'These boards incorporate the target microcontroller with usually additional memory, input-output ports, some LEDs, some switches, programmer, and some other peripheral interfaces such as UART, I2C, SPI, etc.', 
            'thumb' => 'comit1001.jpg'
        ),
        array(
            'id' => '2005',
            'code' => '', 
            'title' => 'Integreated circuits', 
            'subtitle' => 'ICs', 
            'description' => 'an assembly of electronic components with miniature devices built up on a semiconductor substrate', 
            'thumb' => 'comit1002.jpg'
        ),
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
            $this->command->info('Inserted ' . count($this->data) . ' records to component_types table');
        }
        
    }
}
