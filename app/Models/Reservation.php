<?php

namespace App\Models;

use App\Domains\Auth\Models\User;
use App\Models\Stations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'start_date', 'end_date','station_id', 'E_numbers', 'duration'];

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
}

 