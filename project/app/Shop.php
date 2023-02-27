<?php

namespace App;

use App\PaymentSetting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Shop extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
    	 'shop_name','owner_name','shop_number','shop_address','shop_activity','shop_details','shop_email','national_id','national_copy','comercial_reg_copy', 'comercial_reg_number', 'shop_district','shop_city','shop_street','shop_mail_box','shop_postal_code'
    ];
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
    public function products()
    {
    	return $this->hasMany('App\Product');
    }
    public function orders()
    {
    	return $this->hasMany('App\VendorOrder','shop_id');
    }
    public function WithCommission($amount) 
    {

        $t_ps = PaymentSetting::findOrFail(1);

        $actual_amount = round($amount);
        $commission_price = round($t_ps->commission_charges);

        // if commission is set in percentage
        if($t_ps->charge_in_percentage == 1){

            $percent = $this->getPercentOfAmount($actual_amount,$commission_price);
            $amount_after_commission = $actual_amount - $percent;
        }
        // if commission is fixed
        else{
            $amount_after_commission = $actual_amount - $commission_price;
        }

        return $amount_after_commission;
    }

    public function getPercentOfAmount($amount, $percent){
        return ($percent / 100) * $amount;
    }
}