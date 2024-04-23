<?php

namespace App\Models;

use App\Domains\Auth\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function componentItems()
    {
        return $this->belongsToMany(ComponentItem::class)->withPivot('quantity');   
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    

    public function dueDays()
    {
        $now = Carbon::now()->format('Y-m-d');
        $end =  Carbon::parse($this->due_date_to_return);
        return ($end->diffInDays($now));
    }

    public function generateOtp(){
        $otp = rand(1000,9999);
        $this->otp = $otp;
        $this->save();
        return $otp;
    }

    public function checkOtp($otp){
        return $otp==$this->otp;
    }
}
