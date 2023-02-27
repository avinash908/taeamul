<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\PaymentSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:can manage vendors']);
    } 
    public function index()
    {
    	$payment_st = PaymentSetting::findOrFail(1);
        return view('admin.paymentsetting.index',compact('payment_st'));
    }
    public function update(Request $request)
    {
        $validated = $request->validate([
        	'currency_format'		=> 'required|string|max:255',
        	'withdraw_fee'			=> 'required|integer',
        	'commission_charges'	=> 'required|integer',
        	'charge_in'				=> 'required|in:1,0',
        ]);
        if ($validated) {
        	$payment_setting = PaymentSetting::findOrFail(1);
        	$payment_setting->update([
        		'currency_format'		=>	$request->input('currency_format'),
        		'withdraw_fee'			=>	$request->input('withdraw_fee'),
        		'commission_charges'	=>	$request->input('commission_charges'),
        		'charge_in_percentage'	=>	$request->input('charge_in'),
        	]);

        	return redirect()->route('admin.payment.settings')->with('success','Payment Settings Has been Updated!');
        }
    }
}
