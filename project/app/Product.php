<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
    use SoftDeletes;
    
    use \Conner\Tagging\Taggable;
    protected $fillable = [
    	'shop_id','category_id','subcategory_id','childcategory_id','sku','slug','name','description','price','old_price','stock','condition','thumbnail','short_description','status','is_featured','is_bestDeals','is_topRated','is_bestSeller','is_hot','is_new','is_trending','is_sale','attributes',
    ];
    public function image()
    {
    	return $this->morphOne('App\Image', 'imageable');
    }
    public function images()
    {
    	return $this->morphMany('App\Image', 'imageable');
    }
    public function category()
    {
    	return $this->belongsTo('App\Category','category_id');
    }
    public function subcategory()
    {
        return $this->belongsTo('App\SubCategory','subcategory_id');
    }
    public function childcategory()
    {
        return $this->belongsTo('App\ChildCategory','childcategory_id');
    }
    public function sizes()
    {
    	return $this->hasMany('App\Size');
    }
    public function colors()
    {
    	return $this->hasMany('App\Color');
    }
    public function wholesale()
    {
        return $this->hasMany('App\Wholesale');
    }
    public function seo()
    {
        return $this->morphOne('App\Seo', 'seoble');
    }
    public function shop()
    {
    	return $this->belongsTo('App\Shop');
    }
    public function reviews()
    {
       return $this->hasMany('App\Review');
    }
}