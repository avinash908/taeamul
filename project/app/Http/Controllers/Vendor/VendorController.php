<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Shop;
use Auth;
use Hash;
use Session;

class VendorController extends Controller
{
    public function index()
    {
    	return view('vendor.index');
    }
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('login');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('vendor.profile',compact('user'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255',
            'state'=>'required|max:255',
            'city'=>'required|max:255',
            'address'=>'required|max:255',
            'zip'=>'required',
            'image'=>'image',
        ]);

       $user = Auth::user();

       if($request->has('image')){

            $path = '/assets/users/images/';

            $image = $request->file('image');

            $image_name = 'avatar-' . date('YmdHis') . "." . $image->getClientOriginalExtension();

            $image->move(base_path('../'.$path), $image_name);

            $avatar = $path.$image_name;

            $user->image()->update(['url'=>$avatar]);
        }

       $user->update([
        'name'=>$request->input('name'),
        'state'=>$request->input('state'),
        'city'=>$request->input('city'),
        'address'=>$request->input('address'),
        'zip'=>$request->input('zip'),
       ]);

       return redirect()->back()->with('success','Profile Has Been Updated!');
    }

    public function settings()
    {
        return view('vendor.settings');
    }
    public function shopsettings()
    {
        $user = Auth::user();
        return view('vendor.shop_settings',compact('user'));
    }
    public function updateShop(Request $request)
    {
        $request->validate([
            'shop_name'=>'required|max:255',
            'owner_name'=>'required|max:255',
            'shop_email'=>'required|email|max:255',
            'shop_number'=>'required|numeric',
            'comercial_reg_number'=>'required:max:255',
            'national_id'=>'required|max:255',
            'shop_district'=>'required|max:255',
            'shop_city'=>'required|max:255',
            'shop_street'=>'required|max:255',
            'shop_address'=>'required|max:255',
            'shop_mail_box'=>'required|max:255',
            'shop_postal_code'=>'required|max:255',
            'shop_activity'=>'required|max:255',
            'shop_details'=>'required|max:255',
        ]);

        $user = Auth::user();
        $shopdata = $request->all();

        $files_path = 'assets/files/';
        // upload national id copy

        if ($file = $request->file('national_copy')) 
        {              
            $file_n = time().$file->getClientOriginalName();
            $file->move(base_path('../'.$files_path),$file_n);            
            $shopdata['national_copy'] = $files_path .'/'. $file_n;
        } 

        // upload comercial registration copy

        if ($file = $request->file('comercial_reg_copy')) 
        {              
            $file_r = time().$file->getClientOriginalName();
            $file->move(base_path('../'.$files_path),$file_r);            
            $shopdata['comercial_reg_copy'] = $files_path .'/'. $file_r;
        }
        $shop = Shop::findOrFail($user->shop->id);

        $shop->fill($shopdata)->save();

       return redirect()->back()->with('success','Shop Settings has been updated!');
    }
    public function changeEmail(Request $request)
    {
        $request->validate([
            'email'=>'required|email|unique:users,email,'. Auth::user()->id,
        ]);

        Auth::user()->update(['email'=>$request->input('email')]);

        return back()->with('success', 'Email has been changed');
    }
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password'      =>'required',
            'password'              =>'required|min:8|confirmed',
            'password_confirmation' =>'required'
        ]);

        if (!(Hash::check($request->input('current_password'), Auth::user()->password))) {
            return back()->withInput()->with('danger', 'Current password is wrong');
        }
        Auth::user()->fill(['password' => Hash::make($request->input('password'))])->save();

        return back()->with('success', 'Password has been changed');
    }
}
