<!--Sample php file to test scripts using php artisan tinker-->
<?php

$all = \App\Models\EquipmentItem::all();
foreach ($all as $each){
    echo $each->inventoryCode() . "\n";
}

$all = \App\Models\ComponentItem::all();
foreach ($all as $each){
    echo $each->inventoryCode() . "\n";
}

$all = \App\Models\Machines::all();
foreach ($all as $each){
    echo $each->inventoryCode() . "\n";
}

$all = \App\Models\ConsumableItem::all();
foreach ($all as $each){
    echo $each->inventoryCode() . "\n";
}

