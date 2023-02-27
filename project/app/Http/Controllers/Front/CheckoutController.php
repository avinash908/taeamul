<?php

namespace App\Http\Controllers\Front;

use App;
use Auth;
use Cart;
use Session;
use App\User;
use App\Product;
use App\Admin;
use App\Order;
use App\OrderItem;
use App\VendorOrder;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Notifications\OrderNotification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Twilio\Rest\Client;
use Twilio\Jwt\ClientToken;

class CheckoutController extends Controller
{
    public function store_order(OrderRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = null;

        $user_details = [
                'name'=>$request->input('customer_name'),
                'phone'=>$request->input('customer_phone'),
                'address'=>$request->input('customer_address'),
                'city'=>$request->input('customer_city'),
                'state'=>$request->input('customer_state'),
                'zip'=>$request->input('customer_zip'),
        ];

        if (Auth::check()) {
            Auth::user()->update($user_details);
            $input['user_id'] = Auth::user()->id;
        }

        if (!empty($request->createaccount) && !Auth::check()) {
            $validated = $request->validate([
                'customer_email'=> 'required|email|unique:users,email',
                'password'      => 'required|string|min:8|confirmed',
            ]);
            if(!$validated){
                return back()->withInput($request->all());
            }

            $user_details['email']   = $request->input('customer_email');
            $user_details['password'] = Hash::make($request->input('password'));
            $user_details['status'] = 1;

            $user = User::create($user_details);
            $input['user_id'] = $user->id;
            $user->image()->create(['url'=>'assets/images/users/no-image.jpg']);
        }

        if (!empty($request->input('ship_to_different_address'))) {
            $input['ship_to'] = 1;
        }
        if (Session::has('couponDiscount')) {
             $cartTotal = round(Cart::total()) - Session::get('couponDiscount');
            # code...
        }else{
            $cartTotal =round(Cart::total());
        }
        $input['order_number'] = $this->generate_order_no();
        $input['status'] = 'pending';
        $input['total_qty'] = Cart::count();
        $input['total_amount'] = $cartTotal;

        if ($request->has('payment_method') && $request->payment_method != 'cod') {
            $input['payment_method'] = 'other';
            $input['payment_status'] = 1;
        }else{
            $input['payment_method'] = 'cod';
            $input['payment_status'] = 0;
        }
                    
        $order = Order::create($input);

        $items = Cart::content();

        foreach ($items as $item)
        {
            $orderItem = new OrderItem([
                'product_id'    =>  $item->model->id,
                'shop_id'       =>  $item->model->shop_id,
                'quantity'      =>  $item->qty,
                'price'         =>  round($item->price),
                'total_price'   =>  round($item->total),
                'color'         =>  $item->options->color,
                'size'          =>  $item->options->size,
            ]);

            $order->items()->save($orderItem);
        }

        foreach($items as $item)
        {
            if($item->model->shop_id != 0 && $item->model->shop_id != null)
            {
                $vendor_order =  new VendorOrder;
                $vendor_order->order_id = $order->id;
                $vendor_order->shop_id = $item->model->shop_id;
                $vendor_order->product_id = $item->model->id;
                $vendor_order->quantity = $item->qty;
                $vendor_order->price = round($item->price);
                $vendor_order->total_price = round($item->total);
                $vendor_order->color = $item->options->color;
                $vendor_order->size = $item->options->size;
                $vendor_order->order_number = $order->order_number;             
                $vendor_order->save();

                // $this->send_sms($vorder->user_id,$order->order_number,$request->name,$request->phone,$request->address);
            }
        }
        foreach ($items as $decre) {
            $condition = Product::where('id',$decre->id)->get();
            foreach ($condition as $stock) {

                $stock->stock = $stock->stock - $decre->qty;
                $stock->save();

                if ($size = $stock->sizes()->where('title','=',$decre->options->size)->first()) {
                     $size->quantity = $size->quantity - $decre->qty;
                     $size->save();
                }
                if ($color = $stock->colors()->where('code','=',$decre->options->color)->first()) {
                    $color->quantity = $color->quantity - $decre->qty;
                    $color->save();
                }
            }
                
        }

        if ($order) {

            $admins = Admin::all();
            Notification::send($admins, new OrderNotification());

            Cart::destroy();
            Session::forget('couponDiscount');
            session()->put('order_number', $order->order_number);

            return redirect('/checkout-completed')->with('success','Order has been placed');
        }else{
            return redirect()->back()->with('danger','Opps Something Went Wrong!');
        }
    }
    
    public function send_sms($to_user,$order_number,$customer_name,$customer_phone,$customer_address)
    {

        $vendor = User::find($to_user);   
        $accountSid = 'AC7cc81cbf05ae5cff4c3514609e89ad2d';
        $authToken  = '4893247e1a73de31ba612e9ff10a7c12';
        $client = new Client($accountSid, $authToken);
        try
        {
            // Use the client to do fun stuff like send text messages!
            $client->messages->create(
            // the number you'd like to send the message to
                '+'.$vendor->phone,
               array(
                     // A Twilio phone number you purchased at twilio.com/console
                     'from' => '+12015818495',
                     // the body of the text message you'd like to send
                     'body' => 'عزيزي: '.$vendor->shop_name.' لقد تلقيت الطلب رقم : '.$order_number.'
    يرجى الشحن إلى: '.$customer_name.'
     جوال: '.$customer_phone.'
     الموقع: '.$customer_address.'
    
     شكرا 
منصة تعامل
',
                 )
             );
        }
        catch (Exception $e)
        {
            echo "Error: " . $e->getMessage();
        }
    }
    public function generate_order_no()
    {
        $latest = Order::latest()->first();
        if (! $latest) {
            return 'T0001';
        }

        $string = preg_replace("/[^0-9\.]/", '', $latest->order_number);

        $order_number  = 'T' . sprintf('%04d', $string+1);

        return $order_number;
    }
    public function complete_checkout()
    {
        if (session()->has('order_number')) {
            $order = Order::where('order_number','=',session()->get('order_number'))->firstOrFail();
            return view('front.checkoutcompleted',compact('order'));
        }
        return redirect('/');
    }
}