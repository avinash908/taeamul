<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class AttributeOption extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
    	'name', 'slug','attribute_id'
    ];
    public function attribute()
    {
    	return $this->belongsTo('App\Attribute');
    }
}
