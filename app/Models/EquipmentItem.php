<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        else return $this->equipment_type->thumbURL();
    }

}
