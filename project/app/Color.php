<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Color extends Model
{
	use SoftDeletes;
	
    protected $fillable = ['code','name','slug','quantity'];
    public function product()
    {
      return $this->belongsTo('App\Product');
    }
}