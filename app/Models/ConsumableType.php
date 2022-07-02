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

    public function inventoryCode()
    {
        // TODO: Make a common standard for this
        return "MS/CS/" . $this->id;
    }

    // Return the relative URL of the thumbnail
    public function thumbURL()
    {
        if ($this->thumb != null) return '/img/consumable_types/' . $this->thumb;
        else return $this->parent()->thumbURL();
    }

    // Return the parent item of the current type or null
    public function parent()
    {
        if ($this->parent_id !== null) return ConsumableType::find($this->parent_id);
        return null;
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
}
