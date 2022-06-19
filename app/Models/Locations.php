<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    use HasFactory;

    /**
     * Get the parent location
     */
    public function parent_location(){
        return $this->hasOne(Locations::class,"parent_location");
    }
}
