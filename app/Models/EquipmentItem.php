<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentItem extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function equipment_type()
    {
        // TODO: Not a recommended method, need to use belongsTo
        return EquipmentType::find(1)->where('id', $this->equipment_type_id)->first();
        // return $this->belongsTo(EquipmentType::class, 'equipment_type_id', 'id');
    }

    public function thumbURL(){

        if($this->thumb != null) return '/img/equipment_items/'.$this->thumb;
        return null;
    }

}
