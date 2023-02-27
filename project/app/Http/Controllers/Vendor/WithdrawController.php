<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\PaymentWithdraw;
use Auth;
use DataTables;
use App\PaymentSetting;

class WithdrawController extends Controller
{
	public function datatables()
    {
     $datas = Auth::user()->withdraws()->orderBy('id','desc')->get();
             //--- Integrating This Collection Into Datatables
             return Datatables::of($datas)
                                ->addColumn('withdraw_date', function(PaymentWithdraw $data) {
                                  return $data->created_at;
                                })
                                ->editColumn('status',function(PaymentWithdraw $data){
                                	return ucfirst($data->status);
                                })
                                ->editColumn('account',function(PaymentWithdraw $data){
                                	return $data->acc_name;
                                })
                                ->rawColumns(['withdraw_date','account','status'])
                                ->toJson(); //--- Returning Json Data To Client Sid
    }
    public function index()
    {
    	return view('vendor.withdraw.index');
    }
    public function create()
    {  
        if(Auth::user()->shop->current_balance  < 1) 
        {
            return redirect()->route('v-withdraws')->with('danger','Non-sufficient funds!');
        }
        return view('vendor.withdraw.create');
    }
    public function store(Request $request)
    {
    	 $request->validate([
            'amount'=>'required|integer',
            'acc_name' =>'required|max:255',
            'acc_email' =>'required|email|max:255',
            'iban' =>'required|max:255',
            'address' =>'required|max:255',
            'swift' =>'required|max:255',
        ]);
        $amount = round($request->input('amount'));

        if (Auth::user()->shop->current_balance  < 10 || Auth::user()->shop->current_balance < $amount) {
            return back()->with('message','Non-sufficient funds!');
        }
        $method = 'Bank';

        if($ps = PaymentSetting::find(1)){
            $fee = $ps->withdraw_fee;
        }else{
            $fee = 0;
        }

         Auth::user()->withdraws()->create([
            'method' => $method,
            'amount' => $amount,
            'acc_name' => $request->input('acc_name'),
            'acc_email' => $request->input('acc_email'),
            'iban' => $request->input('iban'),
            'swift' => $request->input('swift'),
            'address' => $request->input('address'),
            'reference' => $request->input('reference'),
            'fee' => $fee,
            'status' => 'pending',
         ]);

         return redirect()->route('v-withdraws')->with('success','Your Withdraw Request has been submited!');
    }
}
