<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the parent location
     */
    public function get_parent_location(){
        return $this->hasOne(Locations::class,"id","parent_location");
    }

}
