<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemLocations extends Model
{
    use HasFactory;

    public function Locations()
    {
        return $this->hasOne(Locations::class);
    }
}
