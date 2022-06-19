<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

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

    public function inventoryCode()
    {
        return $this->equipment_type->inventoryCode() . "/" . $this->id;
    }

    // Return the relative URL of the thumbnail
    public function thumbURL()
    {
        if ($this->thumb != null) return '/img/equipment_items/' . $this->thumb;
        return null;
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('admin.search.index', $this->slug);
        return new SearchResult(
            $this,
            $this->title,
            $url
        );
    }
}
