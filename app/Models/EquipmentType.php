<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentType extends Model
{
    use HasFactory;

    protected $guarded = [];

    // A  Unique ID assigned by the inventory management system
    public function inventoryCode()
    {
        return "MS/EQ/" . $this->id;
    }

    // Return the relative URL of the thumbnail
    public function thumbURL()
    {
        if ($this->thumb != null) return '/img/equipment_types/' . $this->thumb;
        return null;
    }

    // Return the parent item of the current type or null
    public function parent()
    {
        if ($this->parent_id !== null) return EquipmentType::find($this->parent_id);
        return null;
    }
}
