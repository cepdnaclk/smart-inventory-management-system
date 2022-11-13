<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stations extends Model
{
    use HasFactory;

    protected $fillable = ['stationName', 'description', 'thumb','capacity'];

    public function inventoryCode()
    {
        return sprintf("ST/%02d",$this->id);
    }

    // Return the relative URL of the thumbnail
    public function thumbURL()
    {
        if ($this->thumb != null) return '/img/stations/' . $this->thumb;
        return null;
    }

    public function inventoryCode()
    {
        return sprintf("ST/%03d", $this->id);
    }

}
