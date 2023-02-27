<?php

namespace App\Http\Controllers\Front;

use Auth;
use App\User;
use Session;
use App\Product;
use App\Message;
use App\Order;
use App\Admin;
use App\Wholesale;
use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ReviewNotification;
use App\Notifications\ContactNotification;
use Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;


class ActionController extends Controller
{
     public function contactUs(Request $request)
    {

         Validator::make($request->all(),[
            'fullName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required'],
            'captcha' => ['required', 'captcha'],
        ])->validate();
         if (Auth::check()) {
            $user_id =Auth::user()->id;
            $user_email =Auth::user()->email;
            $user_name =Auth::user()->name;
         }else{
            $user_id = null;
            $user_name =$request->input('name');
            $user_email =$request->input('email');

         }
        Message::create([
            'name' => $user_name,
            'email' =>$user_email,
            'subject' =>$request->input('subject'),
            'message' =>$request->input('message'),
            'user_id' => $user_id,
        ]);
        $msg ='NEw Notification';
        $admins = Admin::all();
        Notification::send($admins, new ContactNotification($msg));

        $admin = Admin::find(1);
        $data = [
            'name' =>$user_name,
            'email' =>$user_email,
            'subject' =>$request->input('subject'),
            'message' =>$request->input('message'),
            'to' =>$admin->email,
            'url' => route('admin.dashboard'),
        ];
        $mail = Mail::to($admin->email)->send(new ContactMail($data));
        if ($request->ajax()) {
            return response()->json(['success','Message Has Been Submitted !']);
        }
        return redirect()->back()->with('success','Message Has Been Submitted !');


    }
    public function review_store($slug,Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'reviewForm' =>'required|max:255',
        ]);
        if (!$validator->fails()) {
            $product = Product::where('slug',$slug)->first();
            $product->reviews()->create([
            'user_id' => Auth::user()->id,
            'review' =>$request->input('reviewForm'),
            ]);
            if (!empty($product->shop_id)) {
                $vendor = User::where('id',$product->shop()->user_id)->where('is_vendor','=',1);
                $msg = null;
                Notification::send($vendor, new ReviewNotification($msg));
                $admins = Admin::all();
                Notification::send($admins, new ReviewNotification($msg));
            }else{
                $msg = null;
                 $admins = Admin::all();
                Notification::send($admins, new ReviewNotification($msg));
            }
            return response()->json(['success'=>'Review Has Posted !']);
        }
            return response()->json([
                'danger'=>'Review Cannot be Posted !',
                'error'=> $validator->errors()->all(),
            ]);
    }  


    public function commentStore($slug,Request $request)
    {
        $post = Post::where('slug',$slug)->firstOrFail();
        $request->validate([
            'comment'=> 'required|max:255|min:4',
            'name'=> 'required',
            'email'=> 'required|email',
        ]);
        $comment = Comment::create([
            'comment' =>$request->input('comment'),
            'name' =>$request->input('name'),
            'email' =>$request->input('email'),
            'post_id' =>$post->id,
        ]);
        if ($comment) {
            return response()->json(['success'=>'Comment Has Been Posted!']);
            
        }
            return response()->json(['danger'=>'Comment Cannot Be Posted!']);


    }
    public function sizeUpdate($size,$prd)
    {
        if (Session::has('productId') && Session::get('productId') == $prd) {
            $product = Product::where('id',$prd)->first();
            $sizePrice = $product->sizes()->where('id',$size)->first();
            $session = Session::put('productData', $sizePrice->price);
            return response()->json(['price'=>$sizePrice->price]);
        }
        return abort(404);
        // return $sizePrice->price;
         
    }
    public function ProductDefaultPrice($prd)
    {
        if (Session::has('productId') && Session::get('productId') == $prd) {
            $product = Product::where('id',$prd)->first();
            $session = Session::put('productId', $product->id);
            return response()->json(['price'=>$product->price]);
        }
        return abort(404);
    }
    public function WholeSalePrice($id)
    {
        $ws = Wholesale::findOrFail($id);
        if (Session::has('productId') && Session::get('productId') == $ws->product_id) {
            $session = Session::put('productData', $ws->price);
            return response()->json(['price'=>$ws->price,'qty'=>$ws->qty]);
        }
        return abort(404);
    }
}