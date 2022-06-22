<?php

namespace App\Models;

use App\Models\EquipmentItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stations extends Model
{
    use HasFactory;

    protected $fillable = ['stationName', 'description', 'thumb','capacity'];

    
    public function equipment_items()
    {
        return $this->belongsToMany(EquipmentItem::class);
    }
}
