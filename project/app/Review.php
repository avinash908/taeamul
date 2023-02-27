<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Review extends Model
{
    use SoftDeletes;
    
	protected $fillable = [
    	'user_id','review',
    ];

    


    public function product()
    {
    	return $this->belongsTo('App\Product');
    }
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
