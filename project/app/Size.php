<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Size extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
    	'title','slug', 'quantity', 'price','product_id',
    ];

    public function product()
    {
    	return $this->belongsTo('App\Product');
    }
}