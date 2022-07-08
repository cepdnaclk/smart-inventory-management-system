<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemLocations extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function location(){
        return $this->hasOne(Locations::class,"id");
    }

    public function get_item(){
        $item_to_return = null;
        $item_id = $this->item_id;
        $exploded = explode("/", $item_id);
        if ($exploded[0] == "EQ") {
            $get_from_db = EquipmentItem::where('id', end($exploded))->get();
            if (count($get_from_db) > 0) {
                $item_to_return = $get_from_db[0];
            }
        } elseif ($exploded[0] == "MC") {
            $get_from_db = Machines::where('id', end($exploded))->get();
            if (count($get_from_db) > 0) {
                $item_to_return = $get_from_db[0];
            }
        } elseif ($exploded[1] == "CS") {
            $get_from_db = ConsumableItem::where('id', end($exploded))->get();
            if (count($get_from_db) > 0) {
                $item_to_return = $get_from_db[0];
            }
        } elseif ($exploded[0] == "RW") {
            $get_from_db = RawMaterials::where('id', (int)end($exploded))->get();
            if (count($get_from_db) > 0) {
                $item_to_return = $get_from_db[0];
            }
        } elseif ($exploded[0] == "CM") {
            $get_from_db = ComponentItem::where('id', end($exploded))->get();
            if (count($get_from_db) > 0) {
                $item_to_return = $get_from_db[0];
            }
        }
        return $item_to_return;
    }
}
