<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class WholeSaleUnit extends Model
{
	use SoftDeletes;
	
   	protected $fillable = [
   		'unit'
   	];
}
