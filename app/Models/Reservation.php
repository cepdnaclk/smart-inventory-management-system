<?php

namespace App\Models;

use App\Domains\Auth\Models\User;
use App\Models\Stations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'start_date', 'end_date','station_id', 'E_numbers', 'duration', 'thumb', 'thumb_after', 'status', 'comments'];

    public function res_info()
    {
        if ($this->user_id != null) return $this->belongsTo(User::class, 'user_id', 'id');
        return null;
    }

    public function st_info()
    {
        if ($this->station_id != null) return $this->belongsTo(Stations::class, 'station_id', 'id');
        return null;
    }

    // Return the relative URL of the thumbnail
    public function thumbURL()
    {
        if ($this->thumb != null) return '/img/reservations/' . $this->thumb;
        return null;
    }

    // Return the relative URL of the thumbnail after 
    public function thumbURL_after()
    {
        if ($this->thumb_after != null) return '/img/reservations_after/' . $this->thumb_after;
        return null;
    }
}

  