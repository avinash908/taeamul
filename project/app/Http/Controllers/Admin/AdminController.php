<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Auth;
use Hash;
use App\Admin;

class AdminController extends Controller
{
    public function index()
    {
    	$chart_options = [
            'chart_title' => 'Sales by Months',
            'report_type' => 'group_by_date',
            'model' => 'App\Order',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'where_raw' => 'payment_status = 1',
        ];
        $chart1 = new LaravelChart($chart_options);
    	return view('admin.index', compact('chart1'));
    }
    public function profile()
    {
        $user = Auth::guard('admin')->user();
        return view('admin.profile',compact('user'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255',
            'phone'=>'required|max:255',
            'avatar'=>'image',
        ]);

       $user = Auth::guard('admin')->user();

       if($request->has('image')){

            $path = '/assets/admin/images/';

            $image = $request->file('image');

            $image_name = 'avatar-' . date('YmdHis') . "." . $image->getClientOriginalExtension();

            $image->move(base_path('../'.$path), $image_name);

            $avatar = $path.$image_name;

        }else{
            $avatar = 'assets/admin/images/avatar.png';
        }

       $user->update([
        'name'=>$request->input('name'),
        // 'email'=>$request->input('email'),
        'phone'=>$request->input('phone'),
        'avatar'=>$avatar,
       ]);

       return redirect()->back()->with('success','Profile Has Been Updated!');
    }

    public function settings()
    {
        return view('admin.settings');
    }
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password'      =>'required',
            'password'              =>'required|min:8|confirmed',
            'password_confirmation' =>'required'
        ]);

        if (!(Hash::check($request->input('current_password'), Auth::guard('admin')->user()->password))) {
            return back()->withInput()->with('danger', 'Current password is wrong');
        }
        Auth::guard('admin')->user()->fill(['password' => Hash::make($request->input('password'))])->save();

        return back()->with('success', 'Password has been changed');
    }
}
