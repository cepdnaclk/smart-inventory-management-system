<?php

namespace App\Models;

use App\Domains\Auth\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderApproval extends Model
{
    use HasFactory;

    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id'); //order has one orderApproval
    }
    public function lecturer()
    {
        return $this->belongsTo(User::class, 'lecturer_id'); //lecturer has many order Aprrovals
    }
    public function technicalOfficer()
    {
        return $this->belongsTo(User::class, 'technical_officer_id'); //technical_officer  has many order Aprrovals
    }
}
