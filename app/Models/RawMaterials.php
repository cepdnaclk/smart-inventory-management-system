<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class RawMaterials extends Model implements Searchable
{
    use HasFactory;

    protected $guarded = [];

    // reverse search depends on this. Change SearchController.php if you're chaning this
    public function inventoryCode()
    {
        return sprintf("RW/%03d",$this->id);
    }

    // Return the relative URL of the thumbnail
    public function thumbURL()
    {
        if ($this->thumb != null) return '/img/raw_materials/' . $this->thumb;
        return null;
    }

    // Raw material availability options
    public static function availabilityOptions()
    {
        return ['AVAILABLE' => 'Available', 'NOT_AVAILABLE' => 'Not Available', 'CONDITIONALLY_AVAILABLE' => 'Conditionally Available'];
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('admin.raw_materials.show', $this);
        return new SearchResult(
            $this,
            $this->title,
            $url
        );
    }
}
