<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

// use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Auth\Passwords\CanResetPassword;
 // use Illuminate\Foundation\Auth\Access\Authorizable;
// use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
 // use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
// use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Laravel\Cashier\Billable;
use Laravel\Cashier\Contracts\Billable as BillableContract;

use App\Models\Camera;
use App\Models\Plan;

//class User extends Model
class User extends Authenticatable
{
    use Notifiable;
    // use Authenticatable, CanResetPassword, Billable;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'email_verified',
        'trial_ends_at', 'subscription_ends_at',
        'date_format', 'portal', 'permission',
        'sel_menu', 'sel_camera', 'sel_camera_tab', 'sel_account_tab'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /* https://laravel-china.org/courses/laravel-shop/5.5/verifying-mailbox/1546 */
    protected $casts = [
        'email_verified' => 'boolean',
    ];

    public function cameras() {
        return $this->hasMany(Camera::class);
    }

    public function plans() {
        return $this->hasMany(Plan::class);
    }

}
