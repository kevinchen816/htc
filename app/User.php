<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

// use Illuminate\Auth\Authenticatable;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Auth\Passwords\CanResetPassword;
// use Illuminate\Foundation\Auth\Access\Authorizable;
// use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
// use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
// use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use App\Models\Camera;
use App\Models\Plan;

//class User extends Model
class User extends Authenticatable
{
//    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'portal', 'permission', 'sel_menu', 'sel_camera', 'sel_camera_tab', 'sel_account_tab'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function cameras() {
        return $this->hasMany(Camera::class);
    }

    public function plans() {
        return $this->hasMany(Plan::class);
    }

}
