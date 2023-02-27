<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\updateUser;
use App\User;
use App\Order;
use App\Message;
use Auth;
use Str;
use Hash;



class UserController extends Controller
{
    public function __construct()
    {
        
    }
    public function index()
    {
        return view('user.index');
    }

    public function update(updateUser $request )
    {
        Auth::user()->update([
                'name' => $request->input('uname'),
                'phone' => $request->input('pno'),
                'address' => $request->input('addr'),
                'country' => $request->input('country'),
                'city' => $request->input('city'),
        ]);
        if ($request->has('picUser')) {
            
            $url = $request->file('picUser');
            $path = 'assets/images/users/';
            $thumbnail = date('YmdHis') . "." . $url->getClientOriginalExtension();
            $url->move(base_path('../'.$path), $thumbnail);
             $picUp = Auth::user()->image()->update([
                'url' => $path.$thumbnail,
             ]);
        }
        return response()->json(['success'=>'Profile Info Updated']);
    }
    public function updateEmail(Request $request)
    {
           $validation=  $request->validate([
                'email' => 'required|email|unique:users,email,'.Auth::user()->id
            ]);
           if (!$validation) {
            return redirect()->back()->with('danger','Email Cannot Be Changed');
           }
            $email = $request->input('email');
            Auth::user()->update(['email' => $email]);
            return redirect()->back()->with('success','Email Has Been Changed');
    }
    public function updatePassword(Request $request)
    {
        $validation=  $request->validate([
            'c_pass' =>'required',
            'password' =>'required|min:8|confirmed',
            'password_confirmation' =>'required'
        ]);
        if (!(Hash::check($request->input('c_pass'), Auth::user()->password))) {
            return back()->withInput()->with('danger', 'Current password is wrong');
        }
       Auth::user()->fill(['password' => Hash::make($request->input('password'))])->save();
        return back()->with('success', 'Password has been changed');
    }
   


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    public function viewOrderData(Request $request,$slug) 
    {
        $order = Order::where('order_number',$slug)->first();
        if ($order && $order->user_id == Auth::user()->id) {
        $view = view('user.ajax.orderView',compact('order'))->render();
        return response()->json(['html'=>$view]); 
        }
        return redirect()->back(); 

    }


    public function dashboardData(Request $request) 
    {
        $order = Auth::user()->orders()->latest()->take(5)->get();
        $view = view('user.ajax.dashboard',compact('order'))->render();
        return response()->json(['html'=>$view]); 
    }
     public function messageData(Request $request) 
    {
        $rec = Message::where('email',Auth::user()->email)->whereNull('user_id')->latest()->get();
        $view = view('user.ajax.message',compact('rec'))->render();
        return response()->json(['html'=>$view]); 
    }

    public function editProfileData(Request $request) 
    {
        $view = view('user.ajax.edit_profile')->render();
        return response()->json(['html'=>$view]); 
    }
    
    public function ordersData(Request $request) 
    {
        $order = Auth::user()->orders()->latest()->get();
        $view = view('user.ajax.orders',compact('order'))->render();
        return response()->json(['html'=>$view]); 
    }
    
    public function orderTrackingData(Request $request) 
    {
        $view = view('user.ajax.order_tracking')->render();
        return response()->json(['html'=>$view]); 
    }
    
    public function settingsData(Request $request) 
    {
        $view = view('user.ajax.settings')->render();
        return response()->json(['html'=>$view]); 
    }
}