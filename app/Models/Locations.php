<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    use HasFactory;

    public function ItemLocations()
    {
        return $this->belongsTo(ItemLocations::class);
        
    }

    public function get_parent_function(){

        return $this->hasOne(Locations::class,'id','parent_location');

    }


}
