<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Message;

class MessageController extends Controller
{
   public function index()
   {
        $msg = Message::get()->groupBy('email');
         $data = collect($msg);
         $msg = $data->flatten()->unique('email');
         $all = Message::all();
        return view('admin.message.index',compact('msg','all'));
   }
   public function message(Request $request)
   {
        $val =$request->validate([
            'subject'=>'required',           
            'msg'=>'required',         
            'email'=>'required',         
        ]);
        $get = Message::where('email',$request->input('email'))->first();
        if ($val) {
            Message::create([
                'name' => $get->name,
                'email' => $get->email,
                'subject' => $request->input('subject'),
                'message' => $request->input('msg'),
                'message_from' => 'Admin',
            ]);
            return response()->json(['success'=>'Message Has Been sent']);
        }

   }
   public function msgFetch($data)
   {
     $fetch = Message::where('email','=',$data)->get();
     $user = Message::where('email',$data)->first();
     $view = view('admin.message.ajax.msg',compact('fetch','user'))->render();
     return response()->json(['html'=>$view,'userName'=>$user->name,'userEmail'=>$user->email]);
   }
}
