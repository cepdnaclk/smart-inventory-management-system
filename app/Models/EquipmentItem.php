<?php

namespace App\Models;

use App\Models\Stations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EquipmentItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Link the Equipment Type table
    public function equipment_type()
    {
        if ($this->equipment_type_id != null) return $this->belongsTo(EquipmentType::class, 'equipment_type_id', 'id');
        return null;
    }

    public function inventoryCode()
    {
        return $this->equipment_type->inventoryCode() . "/" . $this->id;
    }

    // Return the relative URL of the thumbnail
    public function thumbURL()
    {
        if ($this->thumb != null) return '/img/equipment_items/' . $this->thumb;
        return null;
    }

    // // To create the pivot many-to-many relationship
    // public function stations()
    // {
    //     return $this->belongsToMany(Stations::class, 'equipment_item_stations');
    // }

}
