<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Authenticatable implements MustVerifyEmail
{
    use SoftDeletes;
    
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'country', 'city', 'state', 'zip', 'address', 'phone','status', 'is_vendor'];

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

    public function is_vendor()
    {
        if ($this->is_vendor == 1) {
            return true;
        }
        return false;
    }
    public function shop()
    {
        return $this->hasOne('App\Shop');
    }
    public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
    public function messages()
    {
        return $this->hasMany('App\Message');
    }
    public function withdraws()
    {
        return $this->hasMany('App\PaymentWithdraw');
    }
}