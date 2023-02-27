<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Authenticatable 
{
	use Notifiable;

	use HasRoles;

	use SoftDeletes;

	protected $guard = 'admin';

    protected $fillable = [
    	'name','email','password','phone','status','shop_name','avatar'
    ];

    public function sendPasswordResetNotification($token)
	{
	    $this->notify(new \App\Notifications\AdminResetPasswordNotification($token));
	}
}
