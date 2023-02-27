<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subscriber;
use App\Coupon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CouponNotification;
use App\Mail\CouponMail;
use Validator;
use Session;
use Carbon\Carbon;
use Cart;

class CouponController extends Controller
{
    public function coupon(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'coupon' => 'required',
        ]);
        if ($validate->fails()) {
            return response()->json(['error'=>$validate->errors()->all()]);
        }
        $current = Carbon::now();
        $con =Coupon::where('code',$request->input('coupon'))->where('end_date','<',$current)->first();
        if ($con) {
         return Coupon::where('code',$request->input('coupon'))->update(['status'=>0]);
        }else{

        	if (Session::get('code') == $request->input('coupon')) {
        		return response()->json(['danger'=>'Coupon Code Is Already Used']);
        	}else{
                $query= Coupon::where('code',$request->input('coupon'))->where('status',1)->first();
                if ($query->used >= $query->times) {
                     return response()->json(['danger'=>'Coupon Code Is Expired']);
                }
    	    	if ($query) {
                    if (Cart::content()->count() > 0) {
                        $query->used = $query->used + 1;
                        $query->save();
        	    		$session = Session::put('code',$request->input('coupon'));
                        Session::put('couponTotal',$query->price);

            			return response()->json(['success'=>'Coupon Code Applied']);
                    }
                    return response()->json(['danger'=>'There are no items in cart!']);

    	    	}
        		return response()->json(['danger'=>'Coupon Code Is Incorrect Or Does Not Exists !']);

        	}
        }
    	return abort(404);
    }
    public function couponOnEmail(Request $request)
    {


    	$validate = Validator::make($request->all(),[
    		'input' => 'required|email',
    	]);
    	if ($validate->fails()) {
    		return response()->json(['error'=> $validate->errors()->all()]);
    	}
    	$input = $request->input('input');
    	$q = Subscriber::where('email',$input)->first();
    	if ($q) {
    		return response()->json(['danger'=> 'This Email Is Already Registered']);
    	}else{
    		$subscriber = Subscriber::create(['email' => $input]);
    		$data = Coupon::orderBy('id','desc')->firstOrFail();

    		$data->used = $data->used + 1;

    		$data->save();

    		$coupon = [
    			'coupon'=>$data->code,
    			'endDate'=>$data->end_date,
    		];
    		if ($subscriber) {
    			$subscriber->notify(new CouponNotification($coupon));
    			// Notification::route('mail', $input)->notify(new CouponNotification($coupon));
                return response()->json(['success'=> 'Coupon Code has been Sent!']);
    		}
    			return response()->json(['danger'=> 'Email Cannot Be Registered']);
    	}

    }	

}
