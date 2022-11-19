<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\OrderApproval;
use App\Domains\Auth\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Locker;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public const STATUS = ['PENDING', 'PROGRESS', 'READY', 'PICKEDUP'];


    public function componentItems()
    {
        //return $this->belongsToMany(ComponentItem::class)->withPivot('quantity');   
        return $this->belongsToMany(ComponentItem::class, ComponentItemOrder::class)->withPivot('quantity');
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

    public function generateOtp()
    {
        $otp = rand(1000, 9999);
        $this->otp = $otp;
        $this->save();
        return $otp;
    }

    public function checkOtp($otp)
    {
        return $otp == $this->otp;
    }
    public function orderApprovals()
    {
        return $this->hasOne(OrderApproval::class);  //Order  has one  order Aprrovals
    }

    public function locker()
    {
        return $this->belongsTo(locker::class);
    }

    public static function ordersForTechOfficer()
    {
        // Waiting for TechOfficer approval
        $orders_approval_for_officer = Order::where('status', 'WAITING_TECHNICAL_OFFICER_APPROVAL')->get();

        return $orders_approval_for_officer;
    }

    public static function getReadyOrders()
    {
        return Order::where('status', 'READY')->orderBy('id')->paginate(16);
    }

    public static function getApprovedOrders()
    {
        return Order::where('status', 'APPROVED')->orderBy('id')->paginate(16);
    }

    public static function getPickedOrders()
    {
        return Order::where('status', 'PICKED')->orderBy('id')->paginate(16);
    }
}
