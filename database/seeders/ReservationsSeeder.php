<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationsSeeder extends Seeder
{

    protected $data = [
    
        array('id' => '10', 'user_id' => '1', 'start_date' => '2022-06-17 10:00:00','end_date' => '2022-06-17 11:00:00', 'station_id' => '1', 'E_numbers' => 'E/18/147', 'duration' => '60', 'thumb'=>'', 'thumb_after'=> '', 'status'=> '', 'comments'=>'', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-08-04 15:25:03'),
        array('id' => '11', 'user_id' => '2', 'start_date' => '2022-06-18 10:00:00','end_date' => '2022-06-18 11:00:00',  'station_id' => '1', 'E_numbers' =>'E/18/199', 'duration' => '60', 'thumb'=>'', 'thumb_after'=> '', 'status'=> '', 'comments'=>'', 'created_at' => '2022-06-10 15:23:56', 'updated_at' => '2022-06-10 15:25:03'),
        
          
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        foreach ($this->data as $index => $setting) {
            $result = DB::table('reservations')->insert($setting);

            if (!$result) {
                $this->command->info("Insert failed at record $index.");
                return;
            }
        }

        $this->command->info('Inserted ' . count($this->data) . ' records to reservations table');
    }
}
