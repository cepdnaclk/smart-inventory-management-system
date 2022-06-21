<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMaterials extends Model
{
    use HasFactory;

    protected $guarded = [];

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
}
