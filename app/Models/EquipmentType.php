<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentType extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function thumbURL(){
        if($this->thumb != null) return '/img/equipment_types/'.$this->thumb;
        return null;
    }
}
