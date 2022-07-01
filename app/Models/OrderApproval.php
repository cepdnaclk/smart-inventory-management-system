<?php

namespace App\Models;

use App\Domains\Auth\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderApproval extends Model
{
    use HasFactory;

    public function orders(){
        return $this->belongsTo(Order::class,'order_id');//order has one orderApproval
    }
    public function user()
    {
        return $this->belongsTo(User::class); //lecturer has many order Aprrovals
    }
}
