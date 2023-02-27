<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PaymentSetting extends Model
{
	use SoftDeletes;
	
  protected  $fillable = ['currency_format','withdraw_fee','commission_charges','charge_in_percentage'];
}
