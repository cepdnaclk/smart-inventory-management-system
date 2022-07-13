<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComponentTypeSeeder extends Seeder
{
    protected $data = [
        array('id' => '11', 'parent_id' => NULL, 'code' => '', 'title' => 'Inteiligent Components', 'subtitle' => '', 'description' => ' ', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03'),
        array('id' => '12', 'parent_id' => NULL, 'code' => '', 'title' => 'Non-Inteiligent Components', 'subtitle' => '', 'description' => ' ', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03'),
        array('id' => '13', 'parent_id' => NULL, 'code' => '', 'title' => 'Simple Circuit Components', 'subtitle' => '', 'description' => ' ', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03'),
        array('id' => '14', 'parent_id' => NULL, 'code' => '', 'title' => 'Non-Electonic Components', 'subtitle' => '', 'description' => ' ', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03'),
        array('id' => '15', 'parent_id' => NULL, 'code' => '', 'title' => 'Other Components', 'subtitle' => '', 'description' => ' ', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03'),
        array('id' => '16', 'parent_id' => '11', 'code' => '', 'title' => 'Development Boards', 'subtitle' => '', 'description' => 'These boards incorporate the target microcontroller with additional memory,  and some other peripheral interfaces.', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03'),
        array('id' => '17', 'parent_id' => '11', 'code' => '', 'title' => 'Integrated Circuits', 'subtitle' => 'ICs', 'description' => 'an assembly of electronic components with miniature devices built up on a semiconductor substrate', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-07-04 15:22:56', 'updated_at' => '2021-09-02 05:19:38')

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
