<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Locker extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function orders()
    {
        return $this->hasOne(Order::class);
    }

    public static function getNextLockerId()
    {
        return Locker::orderBy('id', 'desc')->first()->id + 1;
    }

    public static function getAvailableLockers()
    {
        return Locker::where('is_available', '1')->get();
    }
}
