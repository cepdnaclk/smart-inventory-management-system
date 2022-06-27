<?php

namespace App\Models;

use App\Models\EquipmentItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stations extends Model
{
    use HasFactory;

    protected $fillable = ['stationName', 'description', 'thumb','capacity'];

    // To create the pivot many-to-many relationship
    public function equipment_items()
    {
        return $this->belongsToMany(EquipmentItem::class, 'equipment_item_stations');
    }

    // Return the relative URL of the thumbnail
    public function thumbURL()
    {
        if ($this->thumb != null) return '/img/stations/' . $this->thumb;
        return null;
    }

    
}
