<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobRequestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    protected $data = [
        array('id' => '1', 'student' => '1', 'supervisor' => '3', 'student_notes' => 'This is a test', 'supervisor_notes' => NULL, 'other_notes' => NULL, 'machine' => '2', 'material' => '1', 'status' => 'WAITING_SUPERVISOR_APPROVAL', 'file' => '1655084271.zip', 'thumb' => '1655084271.jpg', 'requested_time' => '2022-06-13 01:37:51', 'approved_time' => NULL, 'scheduled_time' => NULL, 'started_time' => NULL, 'completed_time' => NULL, 'finished_time' => NULL, 'material_usage' => '0.00', 'machine_time' => '0', 'created_at' => '2022-06-13 01:37:51', 'updated_at' => '2022-06-13 01:37:51'),
        array('id' => '2', 'student' => '1', 'supervisor' => '3', 'student_notes' => 'This is a test', 'supervisor_notes' => NULL, 'other_notes' => NULL, 'machine' => '2', 'material' => '1', 'status' => 'WAITING_SUPERVISOR_APPROVAL', 'file' => '1655084272.zip', 'thumb' => '1655084272.jpg', 'requested_time' => '2022-06-13 01:37:51', 'approved_time' => NULL, 'scheduled_time' => NULL, 'started_time' => NULL, 'completed_time' => NULL, 'finished_time' => NULL, 'material_usage' => '0.00', 'machine_time' => '0', 'created_at' => '2022-06-13 01:37:51', 'updated_at' => '2022-06-13 01:37:51'),
        array('id' => '3', 'student' => '1', 'supervisor' => '3', 'student_notes' => 'This is a test', 'supervisor_notes' => NULL, 'other_notes' => NULL, 'machine' => '2', 'material' => '1', 'status' => 'PENDING', 'file' => '1655084273.zip', 'thumb' => '1655084273.jpg', 'requested_time' => '2022-06-13 01:37:51', 'approved_time' => NULL, 'scheduled_time' => NULL, 'started_time' => NULL, 'completed_time' => NULL, 'finished_time' => NULL, 'material_usage' => '0.00', 'machine_time' => '0', 'created_at' => '2022-06-13 01:37:51', 'updated_at' => '2022-06-13 01:37:51')
    ];

    public function run()
    {
        foreach ($this->data as $index => $setting) {
            $result = DB::table('job_requests')->insert($setting);

            if (!$result) {
                $this->command->info("Insert failed at record $index.");
                return;
            }
        }

        $this->command->info('Inserted ' . count($this->data) . ' records to job_requests table');
    }
}
