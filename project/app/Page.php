<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Page extends Model
{
	use SoftDeletes;
	
    protected $fillable = ['title','slug','content','type'];

    public function seo()
    {
        return $this->morphOne('App\Seo', 'seoble');
    }
}