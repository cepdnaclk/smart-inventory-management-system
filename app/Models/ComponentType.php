<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComponentType extends Model
{
    use HasFactory;

    protected $guarded = [];  

    // A  Unique ID assigned by the inventory management system
    public function inventoryCode(){
        return "MS/CM/".$this->id;
    }

    // Return the relative URL of the thumbnail
    public function thumbURL()
    {
        if ($this->thumb != null) return '/img/component_types/' . $this->thumb;
        return null;
    }

    // Return the parent item of the current type or null
    public function parent()
    {
        if ($this->parent_id !== null) return ComponentType::find($this->parent_id);
        return null;
    }

     // Return the children item types of this item type
     public function children()
     {
         return ComponentType::where('parent_id', $this->id)->get();
     }
 
     // Return the items listed under this item type
     public function getItems()
     {
         return $this->hasMany(EquipmentItem::class)->get();
     }
    
}
