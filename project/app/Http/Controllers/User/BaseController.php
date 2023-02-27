<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Order;
use App\Message;
use Auth;

class BaseController extends Controller
{
  public function orderTrackData(Request $request)
    {
      if ($request->has('orderId') && $request->has('orderEmail') ) {
        if (Order::where('order_number',$request->input('orderId') ) ) {
          $user = Order::where('order_number',$request->input('orderId'))->first();
          return response()->json(['success'=> $user->status]);
        }
        return response()->json(['danger'=> 'Order Cannot Be Found!']);
      }
        return response()->json(['danger'=> 'Fill The Inputs Given!']);

    }   
     public function message(Request $request)
    {
      $request->validate([
        'subBox'=> 'required',
        'replyBox'=> 'required',
      ]);
        $user_id =Auth::user()->id;
        $user_email =Auth::user()->email;
        $user_name =Auth::user()->name;

        Auth::user()->messages()->create([
          'name'    => $user_name,
          'email'   => auth()->user()->email,
          'subject' =>$request->input('subBox'),
          'message' =>$request->input('replyBox'),
          'message_from'=> 'customer',
        ]);
      
        
      if ($request->ajax()) {
        return response()->json(['success','Message Has Been Submitted !']);
        }
    }
    public function msgData()
    {
      $data = Message::where('email',Auth::user()->email)->get();
      $view = view('user.ajax.inMsg',compact('data'))->render();
      return response()->json(['html'=>$view]);
    }
}
