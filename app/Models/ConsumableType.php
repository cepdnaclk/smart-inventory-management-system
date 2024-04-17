<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsumableType extends Model
{
    use HasFactory;

    protected $guarded = [];

    // A  Unique ID assigned by the inventory management system

    /**
     * @var mixed
     */

    // reverse search depends on this. Change SearchController.php if you're changing this
    public function inventoryCode()
    {
        return "CS/" . $this->id;
    }

    // Return the relative URL of the thumbnail
    public function thumbURL()
    {
        if ($this->thumb != null) return '/img/consumable_types/' . $this->thumb;
        else if ($this->parent()->first() != null) {
            return $this->parent()->first()->thumbURL();
        } else {
            return config('constants.frontend.dummy_thumb');
        }
    }

    // Return the parent item of the current type or null
    public function parent()
    {
        return $this->hasOne(ConsumableType::class, "id", "parent_id");
    }

    // Return the children item types of this item type
    public function children()
    {
        return ConsumableType::where('parent_id', $this->id)->get();
    }

    // Return the items listed under this item type
    public function getItems()
    {
        return $this->hasMany(ConsumableType::class)->get();
    }

    public function getFullConsumableType()
    {
        $item = $this;
        $title = $item->title;
        while (!($item->parent()->first() == NULL)) {
            $item = $item->parent()->first();
            $title = $item->title . " > " . $title;
        }
        return $title;
    }

    public static function getFullTypeList()
    {
        $typeList = ConsumableType::all();
        $types = array();
        foreach ($typeList as $type) {
            $types[$type->id] = $type->getFullConsumableType();
        }
        return $types;
    }
}
