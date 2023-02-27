<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Attribute extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
    	'attributable_id', 'attributable_type', 'name','slug', 'input_name',
    ];

    public function attributable() {
      return $this->morphTo();
    }
    
    public function attribute_options()
    {
    	return $this->hasMany('App\AttributeOption');
    }
}