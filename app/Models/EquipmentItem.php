<?php

namespace App\Models;

use App\Models\Stations;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EquipmentItem extends Model implements Searchable
{
    use HasFactory;

    protected $guarded = [];

    // Link the Equipment Type table
    public function equipment_type()
    {
        if ($this->equipment_type_id != null) return $this->belongsTo(EquipmentType::class, 'equipment_type_id', 'id');
        return null;
    }

    // reverse search depends on this. Change SearchController.php if you're chaning this
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

    public function getSearchResult(): SearchResult
    {
        $url = route('admin.equipment.items.show', $this);
        return new SearchResult(
            $this,
            $this->title,
            $url
        );
    }
}

