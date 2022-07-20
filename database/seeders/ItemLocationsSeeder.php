<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemLocationsSeeder extends Seeder
{
    protected $data = [
        array('location_id' => '13', 'item_id' => 'EQ/22/1001', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '13', 'item_id' => 'EQ/22/1002', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '13', 'item_id' => 'EQ/11/1003', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '13', 'item_id' => 'EQ/23/1004', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '13', 'item_id' => 'EQ/23/1005', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '13', 'item_id' => 'EQ/11/1006', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '13', 'item_id' => 'EQ/11/1007', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '13', 'item_id' => 'EQ/27/1008', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '13', 'item_id' => 'EQ/15/1009', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '6', 'item_id' => 'EQ/15/1009', 'x' => NULL, 'y' => NULL, 'z' => NULL),

        array('location_id' => '5', 'item_id' => 'EQ/22/1010', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '6', 'item_id' => 'EQ/22/1010', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '13', 'item_id' => 'EQ/22/1010', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '13', 'item_id' => 'EQ/15/1011', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '6', 'item_id' => 'EQ/15/1011', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '13', 'item_id' => 'EQ/15/1012', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '13', 'item_id' => 'EQ/15/1013', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '6', 'item_id' => 'EQ/15/1013', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '13', 'item_id' => 'EQ/18/1014', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '13', 'item_id' => 'EQ/18/1015', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '13', 'item_id' => 'EQ/18/1016', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '6', 'item_id' => 'EQ/18/1016', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '5', 'item_id' => 'EQ/18/1016', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '4', 'item_id' => 'EQ/18/1016', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '13', 'item_id' => 'EQ/22/1017', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '13', 'item_id' => 'EQ/22/1018', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '13', 'item_id' => 'EQ/17/1019', 'x' => NULL, 'y' => NULL, 'z' => NULL),

        array('location_id' => '13', 'item_id' => 'EQ/17/1020', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '13', 'item_id' => 'EQ/25/1021', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '13', 'item_id' => 'EQ/25/1022', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '13', 'item_id' => 'EQ/20/1023', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '13', 'item_id' => 'EQ/27/1024', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '13', 'item_id' => 'EQ/19/1025', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '13', 'item_id' => 'EQ/19/1026', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '13', 'item_id' => 'EQ/19/1027', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '13', 'item_id' => 'EQ/19/1028', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '13', 'item_id' => 'EQ/19/1029', 'x' => NULL, 'y' => NULL, 'z' => NULL),

        array('location_id' => '13', 'item_id' => 'EQ/19/1030', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '13', 'item_id' => 'EQ/19/1031', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '13', 'item_id' => 'EQ/19/1032', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '13', 'item_id' => 'EQ/19/1033', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '13', 'item_id' => 'EQ/19/1034', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '13', 'item_id' => 'EQ/19/1035', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '13', 'item_id' => 'EQ/19/1036', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '13', 'item_id' => 'EQ/20/1037', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '31', 'item_id' => 'EQ/20/1038', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '31', 'item_id' => 'EQ/20/1039', 'x' => NULL, 'y' => NULL, 'z' => NULL),

        array('location_id' => '31', 'item_id' => 'EQ/20/1040', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '31', 'item_id' => 'EQ/20/1041', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '31', 'item_id' => 'EQ/20/1042', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '31', 'item_id' => 'EQ/20/1043', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '31', 'item_id' => 'EQ/20/1044', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '31', 'item_id' => 'EQ/20/1045', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '31', 'item_id' => 'EQ/20/1046', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '31', 'item_id' => 'EQ/20/1047', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '31', 'item_id' => 'EQ/20/1048', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '31', 'item_id' => 'EQ/20/1049', 'x' => NULL, 'y' => NULL, 'z' => NULL),

        array('location_id' => '31', 'item_id' => 'EQ/20/1050', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '31', 'item_id' => 'EQ/20/1051', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '31', 'item_id' => 'EQ/20/1052', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '31', 'item_id' => 'EQ/20/1053', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '31', 'item_id' => 'EQ/20/1054', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '31', 'item_id' => 'EQ/20/1055', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '31', 'item_id' => 'EQ/20/1056', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '31', 'item_id' => 'EQ/20/1057', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '31', 'item_id' => 'EQ/20/1058', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '31', 'item_id' => 'EQ/20/1059', 'x' => NULL, 'y' => NULL, 'z' => NULL),

        array('location_id' => '32', 'item_id' => 'EQ/17/1060', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '32', 'item_id' => 'EQ/17/1061', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '32', 'item_id' => 'EQ/17/1062', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '32', 'item_id' => 'EQ/17/1063', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '32', 'item_id' => 'EQ/17/1064', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '32', 'item_id' => 'EQ/17/1065', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '32', 'item_id' => 'EQ/17/1066', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '32', 'item_id' => 'EQ/17/1067', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '32', 'item_id' => 'EQ/17/1068', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '32', 'item_id' => 'EQ/17/1069', 'x' => NULL, 'y' => NULL, 'z' => NULL),

        array('location_id' => '32', 'item_id' => 'EQ/17/1070', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '32', 'item_id' => 'EQ/17/1071', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '32', 'item_id' => 'EQ/17/1072', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '32', 'item_id' => 'EQ/17/1073', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '32', 'item_id' => 'EQ/17/1074', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '32', 'item_id' => 'EQ/17/1075', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '32', 'item_id' => 'EQ/24/1076', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '32', 'item_id' => 'EQ/17/1077', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '6', 'item_id' => 'EQ/17/1078', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '6', 'item_id' => 'EQ/17/1079', 'x' => NULL, 'y' => NULL, 'z' => NULL),

        array('location_id' => '6', 'item_id' => 'EQ/17/1080', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '33', 'item_id' => 'EQ/26/1081', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '33', 'item_id' => 'EQ/26/1082', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '33', 'item_id' => 'EQ/26/1083', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '33', 'item_id' => 'EQ/26/1084', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '33', 'item_id' => 'EQ/26/1085', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '33', 'item_id' => 'EQ/26/1086', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '33', 'item_id' => 'EQ/26/1087', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '33', 'item_id' => 'EQ/26/1088', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '6', 'item_id' => 'EQ/22/1089', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '5', 'item_id' => 'EQ/22/1089', 'x' => NULL, 'y' => NULL, 'z' => NULL),

        array('location_id' => '6', 'item_id' => 'EQ/18/1090', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '6', 'item_id' => 'EQ/22/1091', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '4', 'item_id' => 'EQ/22/1091', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '6', 'item_id' => 'EQ/15/1092', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '6', 'item_id' => 'EQ/15/1093', 'x' => NULL, 'y' => NULL, 'z' => NULL),

        array('location_id' => '5', 'item_id' => 'EQ/17/1100', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '5', 'item_id' => 'EQ/15/1101', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '5', 'item_id' => 'EQ/15/1102', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '5', 'item_id' => 'EQ/15/1103', 'x' => NULL, 'y' => NULL, 'z' => NULL),

        array('location_id' => '4', 'item_id' => 'EQ/22/1110', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '4', 'item_id' => 'EQ/22/1111', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '4', 'item_id' => 'EQ/22/1112', 'x' => NULL, 'y' => NULL, 'z' => NULL),

        array('location_id' => '6', 'item_id' => 'EQ/14/1113', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '4', 'item_id' => 'EQ/14/1113', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '6', 'item_id' => 'EQ/14/1114', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '4', 'item_id' => 'EQ/14/1114', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '4', 'item_id' => 'EQ/14/1115', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '4', 'item_id' => 'EQ/14/1116', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '4', 'item_id' => 'EQ/14/1117', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '4', 'item_id' => 'EQ/14/1118', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '4', 'item_id' => 'EQ/14/1119', 'x' => NULL, 'y' => NULL, 'z' => NULL),

        array('location_id' => '16', 'item_id' => 'EQ/13/1120', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '16', 'item_id' => 'EQ/13/1121', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '16', 'item_id' => 'EQ/13/1122', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '16', 'item_id' => 'EQ/13/1123', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '16', 'item_id' => 'EQ/13/1124', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '16', 'item_id' => 'EQ/13/1125', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '16', 'item_id' => 'EQ/13/1126', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '16', 'item_id' => 'EQ/13/1127', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '16', 'item_id' => 'EQ/13/1128', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '16', 'item_id' => 'EQ/13/1129', 'x' => NULL, 'y' => NULL, 'z' => NULL),

        array('location_id' => '16', 'item_id' => 'EQ/13/1130', 'x' => NULL, 'y' => NULL, 'z' => NULL),

        array('location_id' => '15', 'item_id' => 'EQ/12/1140', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '15', 'item_id' => 'EQ/12/1141', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '6', 'item_id' => 'EQ/12/1142', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '15', 'item_id' => 'EQ/12/1143', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '15', 'item_id' => 'EQ/12/1144', 'x' => NULL, 'y' => NULL, 'z' => NULL),

        array('location_id' => '13', 'item_id' => 'EQ/22/1150', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '12', 'item_id' => 'EQ/29/1152', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '12', 'item_id' => 'EQ/29/1153', 'x' => NULL, 'y' => NULL, 'z' => NULL),

        array('location_id' => '6', 'item_id' => 'EQ/11/1160', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '6', 'item_id' => 'EQ/11/1161', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '6', 'item_id' => 'EQ/22/1162', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '12', 'item_id' => 'EQ/29/1163', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '12', 'item_id' => 'EQ/29/1164', 'x' => NULL, 'y' => NULL, 'z' => NULL),

        array('location_id' => '13', 'item_id' => 'EQ/21/1170', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '17', 'item_id' => 'EQ/21/1171', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '6', 'item_id' => 'EQ/21/1172', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '13', 'item_id' => 'EQ/21/1173', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '13', 'item_id' => 'EQ/21/1174', 'x' => NULL, 'y' => NULL, 'z' => NULL),
        array('location_id' => '13', 'item_id' => 'EQ/21/1175', 'x' => NULL, 'y' => NULL, 'z' => NULL),

    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->data as $index => $setting) {
            $result = DB::table('item_locations')->insert($setting);

            if (!$result) {
                $this->command->info("Insert failed at record $index.");
                return;
            }
        }

        $this->command->info('Inserted ' . count($this->data) . ' records to item_locations table');
    }
}
