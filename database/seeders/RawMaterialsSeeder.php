<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RawMaterialsSeeder extends Seeder
{

    protected $data = [
        array('id' => '1', 'code' => '', 'title' => 'Dot Boards', 'color' => NULL, 'description' => 'Dot Boards can be used for PCB Prototyping', 'specifications' => '24x10cm', 'quantity' => '10.00', 'unit' => 'boards', 'thumb' => '1652179943.jpg', 'availability' => 'AVAILABLE', 'notes' => NULL, 'created_at' => '2022-05-10 10:52:23', 'updated_at' => '2022-05-10 11:31:17'),
        array('id' => '2', 'code' => '', 'title' => 'Copper Clad Board - Single Side', 'color' => NULL, 'description' => 'Copper Clad Laminate, abbreviated to CCL, is a type of base material for PCBs. With glass fiber or wood pulp paper as reinforcing material, a copper-clad board is a type of product through lamination with copper-clad on either one side or both sides of reinforcing material after being soaked in resin.', 'specifications' => 'FR4 standard single-side boards 
      Size: A4', 'quantity' => '10.00', 'unit' => 'boards', 'thumb' => '1652180107.jpg', 'availability' => 'AVAILABLE', 'notes' => NULL, 'created_at' => '2022-05-10 10:55:07', 'updated_at' => '2022-05-10 10:57:55'),
        array('id' => '3', 'code' => '', 'title' => 'Copper Clad Board - Double Side', 'color' => NULL, 'description' => 'Copper Clad Laminate, abbreviated to CCL, is a type of base material for PCBs. With glass fiber or wood pulp paper as reinforcing material, a copper-clad board is a type of product through lamination with copper-clad on either one side or both sides of reinforcing material after being soaked in resin.', 'specifications' => 'FR4 standard double-side boards
      Size: A4', 'quantity' => '5.00', 'unit' => 'boards', 'thumb' => '1652180211.jpg', 'availability' => 'AVAILABLE', 'notes' => NULL, 'created_at' => '2022-05-10 10:56:51', 'updated_at' => '2022-05-10 10:56:51')
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->data as $index => $setting) {
            $result = DB::table('raw_materials')->insert($setting);

            if (!$result) {
                $this->command->info("Insert failed at record $index.");
                return;
            }
        }

        $this->command->info('Inserted ' . count($this->data) . ' records to raw_materials table');
    }
}
