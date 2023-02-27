<?php
namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Message extends Model
{
	use SoftDeletes;
	
    protected $fillable = ['user_id','name','email','subject','message','message_from','read_by_user','read_by_admin'];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}