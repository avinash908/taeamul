<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ChildCategory extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['subcategory_id','name','slug','status'];

    public function subcategory()
    {
    	return $this->belongsTo('App\SubCategory','subcategory_id');
    }

    public function products()
    {
        return $this->hasMany('App\Product','childcategory_id');
    }

    public function attributes() {
        return $this->morphMany('App\Attribute', 'attributable');
    }
    public function seo()
    {
        return $this->morphOne('App\Seo', 'seoble');
    }
}