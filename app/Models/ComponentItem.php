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

    // reverse search depends on this. Change SearchController.php if you're changing this
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

    // used to search
    public function getSearchResult(): SearchResult
    {
        $url = route('admin.component.items.show', $this);
        return new SearchResult(
            $this,
            $this->title,
            $url
        );
    }
}
