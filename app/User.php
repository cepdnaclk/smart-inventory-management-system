<?php

namespace App;

use App\Mail\NewUserWelcome;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable implements MustVerifyEmail
{
    use LaratrustUserTrait;
    use Notifiable;

//    // MongoDB collection
//    protected $collection = 'user';

    public const DEFAULT_USER_TYPE = 'student';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'email', 'password', 'role', 'honorific', 'avatar'
    ];

    public const STUDENT = 'student';
    public const ADMIN = 'admin';
    public const SUPERADMIN = 'superadmin';
    public const MODERATOR = 'moderator';

    public static $roleOptions = [self::STUDENT => 'Student',self::ADMIN => 'Admin',self::SUPERADMIN => 'Super Admin', self::MODERATOR => 'Moderator'];
    public static $honorificOptions = ['Mr.' => 'Mr.', 'Miss.' => 'Miss.', 'Mrs.' => 'Mrs.', 'Dr.' => 'Dr.', 'Prof.' => 'Prof.'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($user) {
            // Send an email - TODO: Need to prepare the formatting
            Mail::to($user->email)->send(new NewUserWelcome($user->email, $user->email));
        });
    }

    public function getUserName()
    {
        return ($this->name != '') ? ($this->honorific . " " . $this->name) : null;
    }

    public function profileImage()
    {
        return (($this->avatar) ? $this->avatar : '/storage/profile/MtpyrBaoXds78Rs13ZwOaSSkPFo5cl4IC7dHH3U8');
    }

}
