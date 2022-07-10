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
        else if ($this->parent() != null) {
            return $this->parent()->thumbURL();
        } else {
            return null;
        }
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
