<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class ComponentItem extends Model implements Searchable
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
