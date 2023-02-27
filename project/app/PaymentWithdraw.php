<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PaymentWithdraw extends Model
{
	use SoftDeletes;
	
    protected $fillable = ['user_id', 'method', 'acc_email', 'iban', 'acc_name', 'address', 'swift', 'reference', 'amount', 'fee', 'status'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    // public function shop()
    // {
    //     return $this->belongsTo('App\Shop');
    // }
}