<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PostCategory extends Model
{
   use SoftDeletes;
   
    protected $fillable = ['title','slug'];

    public function post()
    {
    	return $this->HasMany('App\Post');
    }
    public function seo()
    {
        return $this->morphOne('App\Seo', 'seoble');
    }
}