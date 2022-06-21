<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class ConsumableItem extends Model implements Searchable
{
    use HasFactory;

    protected $guarded = [];

    // Link the Component Type table
    public function consumable_type()
    {
        if ($this->consumable_type_id != null) return $this->belongsTo(ConsumableType::class, 'consumable_type_id', 'id');
        return null;
    }

    // reverse search depends on this. Change SearchController.php if you're chaning this
    public function inventoryCode()
    {
        return $this->consumable_type->inventoryCode() . "/" . $this->id;
    }

    // Return the relative URL of the thumbnail
    public function thumbURL()
    {
        if ($this->thumb != null) return '/img/consumable_items/' . $this->thumb;
        return null;
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('admin.consumable.items.show', $this);
        return new SearchResult(
            $this,
            $this->title,
            $url
        );
    }
}
