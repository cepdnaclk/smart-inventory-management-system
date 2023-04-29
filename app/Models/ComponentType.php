<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComponentType extends Model
{
    use HasFactory;
    protected $guarded = [];

    // A  Unique ID assigned by the inventory management system
    // reverse search depends on this. Change SearchController.php if you're changing this
    public function inventoryCode()
    {
        return sprintf("CM/%02d", $this->id);
    }

    // Return the relative URL of the thumbnail
    public function thumbURL()
    {
        if ($this->thumb != null) return '/img/component_types/' . $this->thumb;
        else if ($this->parent()->first() != null) {
            return $this->parent()->first()->thumbURL();
        } else {
            return config('constants.frontend.dummy_thumb');
        }
    }

    // Return the parent item of the current type or null
    public function parent()
    {
        return $this->hasOne(ComponentType::class, "id", "parent_id");
    }

    // Return the children item types of this item type
    public function children()
    {
        return ComponentType::where('parent_id', $this->id)->get();
    }

    // Return the items listed under this item type
    public function getItems()
    {
        return $this->hasMany(ComponentItem::class)->get();
    }

    /**
     * Get the parent component type
     */
    public function getParent()
    {
        return $this->hasOne(ComponentType::class, "id", "parent_id");
    }

    public function getFullComponentType()
    {
        $item = $this;
        $title = $item->title;
        while (!($item->getParent()->first() == NULL)) {
            $item = $item->getParent()->first();
            $title = $item->title . " > " . $title;
        }
        return $title;
    }

    public static function getFullTypeList()
    {
        $typeList = ComponentType::all();
        $types = array();
        foreach ($typeList as $type) {
            $types[$type->id] = $type->getFullComponentType();
        }
        return $types;
    }
}
