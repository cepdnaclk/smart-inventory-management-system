# $all = \App\Models\EquipmentItem::all();
# foreach ($all as $each){
#     echo $each->inventoryCode() . "\n";
# }
#
# $all = \App\Models\ComponentItem::all();
# foreach ($all as $each){
#     echo $each->inventoryCode() . "\n";
# }
#
# $all = \App\Models\Machines::all();
# foreach ($all as $each){
#     echo $each->inventoryCode() . "\n";
# }
#
# $all = \App\Models\ConsumableItem::all();
# foreach ($all as $each){
#     echo $each->inventoryCode() . "\n";
# }

inventory_codes = """EQ/17/1000
                     EQ/17/1001
                     EQ/17/1002
                     EQ/17/1003
                     EQ/17/1004
                     EQ/17/1005
                     EQ/17/1006
                     EQ/17/1007
                     EQ/17/1008
                     EQ/17/1009
                     EQ/17/1010
                     EQ/17/1011
                     EQ/17/1012
                     EQ/17/1013
                     EQ/17/1014
                     EQ/17/1015
                     EQ/17/1016
                     EQ/17/1017
                     EQ/24/1018
                     EQ/17/1019
                     EQ/25/1020
                     EQ/25/1021
                     EQ/22/1022
                     EQ/19/1023
                     EQ/11/1024
                     EQ/13/1025
                     EQ/15/1026
                     EQ/15/1027
                     EQ/15/1028
                     EQ/15/1029
                     EQ/22/1030
                     EQ/22/1031
                     EQ/11/1032
                     EQ/11/1033
                     EQ/18/1034
                     EQ/18/1035
                     EQ/18/1036
                     EQ/17/1037
                     EQ/17/1038
                     EQ/17/1039
                     EQ/19/1040
                     EQ/19/1041
                     EQ/22/1042
                     EQ/23/1043
                     EQ/22/1044
                     EQ/21/1045
                     EQ/17/1046
                     EQ/20/1047
                     EQ/20/1048
                     EQ/20/1049
                     EQ/20/1050
                     EQ/20/1051
                     EQ/20/1052
                     EQ/19/1053
                     CM/16/1001
                     CM/17/1002
                     MC/001
                     MC/002
                     MS/CS/12/1001
                     MS/CS/12/1002
                     MS/CS/12/1003
                     MS/CS/12/1004
                     MS/CS/12/1005
                     MS/CS/12/1006
                     MS/CS/12/1007
                     MS/CS/12/1008
                     MS/CS/12/1009
                     MS/CS/12/1010
                     MS/CS/12/1011
                     MS/CS/12/1012
                     MS/CS/12/1013
                     MS/CS/12/1014
                     MS/CS/12/1015
                     MS/CS/12/1016
                     MS/CS/12/1017
                     MS/CS/12/1018
                     MS/CS/12/1019
                     MS/CS/12/1020
                     MS/CS/12/1021
                     MS/CS/12/1022
                     MS/CS/12/1023
                     MS/CS/12/1024
                     MS/CS/12/1025
                     MS/CS/12/1026
                     MS/CS/12/1027
                     MS/CS/12/1028
                     MS/CS/12/1029
                     MS/CS/13/1030
                     MS/CS/13/1031
                     MS/CS/13/1032
                     MS/CS/13/1033
                     MS/CS/13/1034
                     MS/CS/13/1035
                     MS/CS/13/1036
                     MS/CS/13/1037
                     MS/CS/13/1038
                     MS/CS/13/1039
                     MS/CS/13/1040
                     MS/CS/13/1041
                     MS/CS/13/1042
                     MS/CS/13/1043
                     MS/CS/13/1044
                     MS/CS/13/1045
                     MS/CS/13/1046
                     MS/CS/13/1047
                     MS/CS/13/1048
                     MS/CS/13/1049
                     MS/CS/13/1050
                     MS/CS/13/1051
                     MS/CS/15/1052
                     MS/CS/15/1053
                     MS/CS/15/1054
                     MS/CS/15/1055
                     MS/CS/15/1056
                     MS/CS/15/1057
                     MS/CS/15/1058
                     MS/CS/16/1059
                     MS/CS/16/1060
                     MS/CS/17/1061
                     MS/CS/17/1062
                     MS/CS/17/1063
                     MS/CS/17/1064
                     MS/CS/17/1065
                     MS/CS/17/1066
                     MS/CS/17/1067
                     MS/CS/17/1068
                     MS/CS/17/1069
                     MS/CS/17/1070
                     MS/CS/17/1071
                     MS/CS/17/1072
                     MS/CS/17/1073
                     MS/CS/17/1074
                     MS/CS/17/1075
                     MS/CS/17/1076
                     MS/CS/17/1077
                     MS/CS/17/1078
                     MS/CS/17/1079
                     MS/CS/17/1080
                     MS/CS/17/1081
                     MS/CS/17/1082
                     MS/CS/17/1083
                     MS/CS/17/1084
                     MS/CS/17/1085
                     MS/CS/17/1086
                     MS/CS/17/1087
                     MS/CS/17/1088
                     MS/CS/17/1089
                     MS/CS/17/1090
                     MS/CS/17/1091
                     MS/CS/17/1092
                     MS/CS/19/1093
                     MS/CS/19/1094
                     MS/CS/22/1095
                     MS/CS/22/1096
                     MS/CS/24/1097
                     MS/CS/24/1098
                     MS/CS/24/1099
                     MS/CS/24/1100
                     MS/CS/24/1101
                     MS/CS/27/1102
                     MS/CS/27/1103
                     MS/CS/31/1104
                     MS/CS/31/1105
                     MS/CS/32/1106
                     MS/CS/32/1107
                     MS/CS/32/1108
                     MS/CS/32/1109
                     MS/CS/32/1110
                     MS/CS/32/1111
                     MS/CS/33/1112
                     MS/CS/33/1113
                     MS/CS/34/1114
                     MS/CS/34/1115
                     MS/CS/35/1116
                     MS/CS/35/1117
                     MS/CS/35/1118
                     MS/CS/35/1119
                     MS/CS/35/1120
                     MS/CS/36/1121
                     MS/CS/36/1122
                     MS/CS/38/1123
                     MS/CS/38/1124
                     MS/CS/38/1125
                     MS/CS/38/1126
                     MS/CS/38/1127
                     MS/CS/39/1128"""

location_id = 0
id = 0
for each in inventory_codes.split():
    print(f"array('id' => '{id}',  'location_id' => {location_id}, 'item_id' => '{each}'),")
    id += 1
    location_id += 1
    if location_id == 3:
        location_id = 0