<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Banner extends Model
{
	use SoftDeletes;
	
    protected $fillable = ['position','image','content','postion','link','title','offer'];
}