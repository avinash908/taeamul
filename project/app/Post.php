<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Post extends Model
{
    use SoftDeletes;
    
    use \Conner\Tagging\Taggable;

    protected $table = 'posts';
    protected $fillable = [
		'slug',
		'title',
    	'data',
    	'thumbnail',
    	'category_id',
	];

	public function category()
    {
    	return $this->belongsTo('App\PostCategory');
    }
    public function comment()
    {
    	return $this->hasMany('App\Comment','post_id');
    }
    public function seo()
    {
        return $this->morphOne('App\Seo', 'seoble');
    }
}
