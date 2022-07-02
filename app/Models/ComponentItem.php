<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComponentItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Link the Component Type table
    public function component_type()
    {
        if ($this->component_type_id != null) return $this->belongsTo(ComponentType::class, 'component_type_id', 'id');
        return null;
    }

    public function inventoryCode()
    {
        return $this->component_type->inventoryCode() . "/" . $this->id;
    }

    // Return the relative URL of the thumbnail
    public function thumbURL()
    {
        if ($this->thumb != null) return '/img/component_items/' . $this->thumb;
        return null;
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class,ComponentItemOrder::class);   
    }

}
