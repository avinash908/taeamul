<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
class Subscriber extends Model
{
	use SoftDeletes;
	
	use Notifiable;
	
    protected $fillable = ['email'];
}
