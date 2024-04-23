<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentType extends Model
{
    use HasFactory;

    protected $guarded = [];

    // A  Unique ID assigned by the inventory management system
    // reverse search depends on this. Change SearchController.php if you're changing this
    public function inventoryCode()
    {
        return sprintf("EQ/%02d", $this->id);
    }

    // Return the relative URL of the thumbnail
    public function thumbURL()
    {
        if ($this->thumb != null) return '/img/equipment_types/' . $this->thumb;
        else if ($this->parent()->first() != null) {
            return $this->parent()->first()->thumbURL();
        } else {
            return config('constants.frontend.dummy_thumb');
        }
    }

    // Return the parent item id
    public function parent_id()
    {
        if ($this->parent_id !== null) return EquipmentType::find($this->parent_id);
        return null;
    }

    // Return the parent item
    public function parent()
    {
        return $this->hasOne(EquipmentType::class, "id", "parent_id");
    }

    // Return the children item types of this item type
    public function children()
    {
        return EquipmentType::where('parent_id', $this->id)->get();
    }

    public static function getFullTypeList()
    {
        $typeList = EquipmentType::all();
        $types = array();
        foreach ($typeList as $type) {
            $types[$type->id] = $type->getFullEquipmentType();
        }
        return $types;
    }

    public function getFullEquipmentType()
    {
        $item = $this;
        $fullTitle = $this->title;
        while (!($item->parent()->first() == NULL || $item->parent()->first()->id == NULL)) {
            $item = $item->parent()->first();
            $fullTitle = $item->title . " > " . $fullTitle;
        }
        return $fullTitle;
    }

    // Return the items listed under this item type
    public function getItems()
    {
        return $this->hasMany(EquipmentItem::class)->get();
    }
}
