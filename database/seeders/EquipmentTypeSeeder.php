<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquipmentTypeSeeder extends Seeder
{
    protected $data = [
        array('id' => '11', 'code' => '', 'parent_id' => NULL, 'title' => 'Hand Tools', 'subtitle' => NULL, 'description' => 'Nonelectrical tools that used to make physical changes to objects.', 'thumb' => '1656746788.jpg', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-08-04 15:25:03'),
        array('id' => '12', 'code' => '', 'parent_id' => NULL, 'title' => 'Power Tools', 'subtitle' => NULL, 'description' => 'Electrical tools and machines that used to make physical changes to objects.', 'thumb' => '1656746798.jpg', 'created_at' => '2021-08-04 15:24:54', 'updated_at' => '2021-08-04 15:24:54'),
        array('id' => '13', 'code' => '', 'parent_id' => NULL, 'title' => 'Safety Equipment', 'subtitle' => NULL, 'description' => 'Wearable equipment which are used for the protection of life and to avoid injuries.', 'thumb' => '1656746809.jpg', 'created_at' => '2021-08-04 15:27:16', 'updated_at' => '2021-08-04 15:27:16'),
        array('id' => '14', 'code' => '', 'parent_id' => NULL, 'title' => 'Soldering Tools', 'subtitle' => NULL, 'description' => 'Tools that are related to soldering', 'thumb' => '1656746819.jpg', 'created_at' => '2021-08-04 16:10:20', 'updated_at' => '2021-08-04 16:10:20'),
        array('id' => '15', 'code' => '', 'parent_id' => NULL, 'title' => 'Measuring Instruments', 'subtitle' => 'Physical Measurements', 'description' => 'Tools that are used to take measurements', 'thumb' => '1656746829.png', 'created_at' => '2021-08-04 16:11:20', 'updated_at' => '2021-08-04 16:11:35'),
        array('id' => '17', 'code' => '', 'parent_id' => '11', 'title' => 'Screwdrivers', 'subtitle' => NULL, 'description' => 'A screwdriver is a tool, manual or powered, used for driving screws. A typical simple screwdriver has a handle and a shaft, ending in a tip the user puts into the screw head before turning the handle.', 'thumb' => '1629005722.jpg', 'created_at' => '2021-08-15 05:33:05', 'updated_at' => '2021-08-15 05:45:03'),
        array('id' => '18', 'code' => '', 'parent_id' => '11', 'title' => 'Pliers', 'subtitle' => NULL, 'description' => 'Pliers are a hand tools used to hold objects firmly', 'thumb' => '1629006269.jpg', 'created_at' => '2021-08-15 05:44:29', 'updated_at' => '2021-08-15 05:44:29'),
        array('id' => '19', 'code' => '', 'parent_id' => '27', 'title' => 'Combination Wrenches', 'subtitle' => NULL, 'description' => 'A wrench or spanner is a tool used to provide grip and mechanical advantage in applying torque to turn objects', 'thumb' => '1655880773.jpg', 'created_at' => '2021-08-15 05:47:05', 'updated_at' => '2022-06-22 06:58:50'),
        array('id' => '20', 'code' => '', 'parent_id' => '28', 'title' => 'Half Inch Sockets', 'subtitle' => '1/2" Sockets', 'description' => 'Half Inch Sockets are a range of metric sockets that come with a 0.5-inch box type head. There are a set of sockets and accessories available in this family of tools.', 'thumb' => '1655880450.jpg', 'created_at' => '2021-08-15 05:53:12', 'updated_at' => '2022-06-22 07:00:02'),
        array('id' => '21', 'code' => '', 'parent_id' => '11', 'title' => 'Clamps', 'subtitle' => NULL, 'description' => 'A brace, band, or clasp for strengthening or holding things together', 'thumb' => '1629008372.jpg', 'created_at' => '2021-08-15 06:19:33', 'updated_at' => '2021-08-15 06:19:33'),
        array('id' => '22', 'code' => '', 'parent_id' => '11', 'title' => 'Cutters and Saws', 'subtitle' => NULL, 'description' => 'Used to cut or separate the workpiece', 'thumb' => '1629008575.jpg', 'created_at' => '2021-08-15 06:22:55', 'updated_at' => '2021-08-15 07:33:08'),
        array('id' => '23', 'code' => '', 'parent_id' => '11', 'title' => 'Hammers', 'subtitle' => NULL, 'description' => 'Hammer is a standard hand tool that is mostly used for striking objects', 'thumb' => '1629008659.jpg', 'created_at' => '2021-08-15 06:24:19', 'updated_at' => '2021-08-15 06:24:19'),
        array('id' => '24', 'code' => '', 'parent_id' => '28', 'title' => 'Quarter Inch Sockets', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL, 'created_at' => '2021-08-17 11:26:40', 'updated_at' => '2022-06-22 07:00:17'),
        array('id' => '25', 'code' => '', 'parent_id' => '11', 'title' => 'Files', 'subtitle' => NULL, 'description' => 'A file is a tool used to remove fine amounts of material from a workpiece', 'thumb' => '1629630206.jpg', 'created_at' => '2021-08-22 11:03:26', 'updated_at' => '2021-08-22 11:03:26'),
        array('id' => '26', 'code' => '', 'parent_id' => '27', 'title' => 'Double Open Wrenches', 'subtitle' => NULL, 'description' => 'A wrench or spanner is a tool used to provide grip and mechanical advantage in applying torque to turn objects', 'thumb' => '1655880526.jpg', 'created_at' => '2021-08-15 05:47:05', 'updated_at' => '2022-06-22 06:58:08'),
        array('id' => '27', 'code' => '', 'parent_id' => '11', 'title' => 'Wrenches', 'subtitle' => NULL, 'description' => 'A wrench or spanner is a tool used to provide grip and mechanical advantage in applying torque to turn objects', 'thumb' => '1655880945.jpg', 'created_at' => '2022-06-22 06:55:45', 'updated_at' => '2022-06-22 06:55:45'),
        array('id' => '28', 'code' => '', 'parent_id' => '11', 'title' => 'Sockets', 'subtitle' => NULL, 'description' => 'Sockets are tools used to tighten mechanical fasteners. They fit over the head of the fastener to provide torque.', 'thumb' => '1655881186.jpg', 'created_at' => '2022-06-22 06:59:46', 'updated_at' => '2022-06-22 07:00:48'),
        array('id' => '29', 'code' => '', 'parent_id' => '12', 'title' => 'Tool Accessories', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL, 'created_at' => '2022-06-25 12:51:37', 'updated_at' => '2022-06-25 12:51:37'),
        array('id' => '30', 'code' => '', 'parent_id' => NULL, 'title' => 'Custom Made Equipment', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL, 'created_at' => '2022-09-22 18:28:59', 'updated_at' => '2022-09-22 18:28:59'),
        array('id' => '31', 'code' => '', 'parent_id' => NULL, 'title' => 'Other', 'subtitle' => NULL, 'description' => NULL, 'thumb' => NULL, 'created_at' => '2022-09-22 18:29:55', 'updated_at' => '2022-09-22 18:29:55')
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->data as $index => $setting) {
            $result = DB::table('equipment_types')->insert($setting);

            if (!$result) {
                $this->command->info("Insert failed at record $index.");
                return;
            }
        }

        $this->command->info('Inserted ' . count($this->data) . ' records to equipment_types table');
    }
}
