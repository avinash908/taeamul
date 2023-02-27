<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Wholesale extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
    	'product_id', 'qty','unit','price',
    ];

    public function product()
    {
    	return $this->belongsTo('App\Product');
    }
}