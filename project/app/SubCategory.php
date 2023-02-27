<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SubCategory extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['category_id','name','slug','status'];

    public function childs()
    {
    	return $this->hasMany('App\ChildCategory','subcategory_id')->where('status','=',1);
    }

    public function category()
    {
    	return $this->belongsTo('App\Category','category_id');
    }

    public function products()
    {
        return $this->hasMany('App\Product','subcategory_id');
    }

    public function attributes() {
        return $this->morphMany('App\Attribute', 'attributable');
    }
    public function seo()
    {
        return $this->morphOne('App\Seo', 'seoble');
    }
}
