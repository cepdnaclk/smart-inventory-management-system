<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConsumableTypeSeeder extends Seeder
{
    protected $data = [
        array('id' => '11', 'parent_id' => NULL, 'code' => '', 'title' => 'Resistors', 'subtitle' => '', 'description' => 'Various types of resistors', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-07-04 15:20:56', 'updated_at' => '2021-07-04 15:21:03')
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
            $this->command->info('Inserted ' . count($this->data) . ' records to consumable_types table');
        }
    }
}
