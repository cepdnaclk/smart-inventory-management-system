<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComponentTypeSeeder extends Seeder
{
    protected $data = [
        array(
            'id' => '11',
            'code' => '', 
            'title' => 'Inteiligent Components', 
            'parent_id' => NULL, 
            'subtitle' => '', 
            'description' => ' ', 
            'thumb' => 'comit1001.jpg',
            'created_at' => '2021-07-04 15:20:56',
            'updated_at' => '2021-07-04 15:21:03'
        ),

        array(
            'id' => '12',
            'code' => '', 
            'title' => 'Non - Inteiligent Components', 
            'parent_id' => NULL, 
            'subtitle' => '', 
            'description' => ' ', 
            'thumb' => 'comit1001.jpg',
            'created_at' => '2021-07-04 15:20:56',
            'updated_at' => '2021-07-04 15:21:03'
        ),

        array(
            'id' => '13',
            'code' => '', 
            'title' => 'simple circuit Components', 
            'parent_id' => NULL, 
            'subtitle' => '', 
            'description' => ' ', 
            'thumb' => 'comit1001.jpg',
            'created_at' => '2021-07-04 15:20:56',
            'updated_at' => '2021-07-04 15:21:03'
        ),

        array(
            'id' => '14',
            'code' => '', 
            'title' => 'Non-Electonic Components', 
            'parent_id' => NULL, 
            'subtitle' => '', 
            'description' => ' ', 
            'thumb' => 'comit1001.jpg',
            'created_at' => '2021-07-04 15:20:56',
            'updated_at' => '2021-07-04 15:21:03'
        ),

        array(
            'id' => '15',
            'code' => '', 
            'title' => 'Ohter Components', 
            'parent_id' => NULL, 
            'subtitle' => '', 
            'description' => ' ', 
            'thumb' => 'comit1001.jpg',
            'created_at' => '2021-07-04 15:20:56',
            'updated_at' => '2021-07-04 15:21:03'
        ),

        array(
            'id' => '16',
            'code' => '', 
            'parent_id' => '11', 
            'title' => 'Development boards', 
            'subtitle' => '', 
            'description' => 'These boards incorporate the target microcontroller with additional memory,  and some other peripheral interfaces.', 
            'thumb' => 'comit1001.jpg',
            'created_at' => '2021-07-04 15:20:56',
            'updated_at' => '2021-07-04 15:21:03'
        ),
        
        array(
            'id' => '17',
            'code' => '', 
            'parent_id' => '11', 
            'title' => 'Integreated circuits', 
            'subtitle' => 'ICs', 
            'description' => 'an assembly of electronic components with miniature devices built up on a semiconductor substrate', 
            'thumb' => 'comit1002.jpg',
            'created_at' => '2021-07-04 15:22:56',
            'updated_at' => '2021-07-04 15:23:03'
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
