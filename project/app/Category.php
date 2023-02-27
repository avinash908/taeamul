<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
    	'name','slug','is_featured','status',
    ];

    public function subs()
    {
      return $this->hasMany('App\SubCategory','category_id')->where('status','=',1);
    }

    public function products()
    {
        return $this->hasMany('App\Product','category_id');
    }

    public function attributes() {
      return $this->morphMany('App\Attribute', 'attributable');
    }
    public function seo()
    {
        return $this->morphOne('App\Seo', 'seoble');
    }
}