<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Seo extends Model
{
	use SoftDeletes;
	
    protected $table = 'seo';
    
    protected $fillable = [
    	'title','meta_tags','meta_description',
    ];

    protected $casts = ['meta_tags' => 'array'];

    public function seoble()
    {
        return $this->morphTo();
    }
}
