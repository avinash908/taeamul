<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ContactDetail extends Model
{
	use SoftDeletes;
	
    protected $fillable = ['email','phone','address','info','facebook','twitter','youtube','instagram','pinterest','gmail','whatsapp','tumblr'];
}
