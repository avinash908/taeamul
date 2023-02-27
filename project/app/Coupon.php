<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Coupon extends Model
{
	use SoftDeletes;
	
    protected $fillable = ['code','price','times','used','status','start_date','end_date'];
}
