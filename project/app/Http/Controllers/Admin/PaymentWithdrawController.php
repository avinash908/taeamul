<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\PaymentWithdraw;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class PaymentWithdrawController extends Controller
{
   public function __construct()
    {
        $this->middleware(['permission:can manage vendors']);
    }
    public function datatables()
    {
     $datas = PaymentWithdraw::orderBy('id','desc')->get();
             //--- Integrating This Collection Into Datatables
             return Datatables::of($datas)
                                ->addColumn('name', function(PaymentWithdraw $data) {
                                    $name = $data->user->name;
                                    return '<a href="" target="_blank">'. $name .'</a>';
                                }) 
                                ->addColumn('email', function(PaymentWithdraw $data) {
                                    $email = $data->user->email;
                                    return $email;
                                }) 
                                ->addColumn('phone', function(PaymentWithdraw $data) {
                                    $phone = $data->user->phone;
                                    return $phone;
                                }) 
                                ->addColumn('amount', function(PaymentWithdraw $data) {
                                    $amount = number_format($data->amount);
                                    return $amount;
                                })

                                ->editColumn('status', function(PaymentWithdraw $data) {
                                    if($data->status == 'completed'){
                                        return '<div class="dropdown">
                                          <button type="button" class="badge badge-success dropdown-toggle" id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            Completed
                                          </button>
                                          <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="dropdown-item badge t_withdraw_status" data-msg="You are changing this withdraw Request to pending!." data-url="'.route("admin.vendor.payment.withdraw.status",[$data->id,'pending']).'" href="javascript:void(0)"> Pending</a>
                                            <a class="dropdown-item badge t_withdraw_status"  data-msg="You are about to reject this withdraw Request!." data-url="'.route("admin.vendor.payment.withdraw.status",[$data->id,'rejected']).'" href="javascript:void(0)"> Rejected</a>
                                          </div>
                                        </div>';
                                    
                                    }elseif ($data->status == 'rejected') {
                                         return '<div class="dropdown">
                                          <button type="button" class="badge badge-dark dropdown-toggle" id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            Rejected
                                          </button>
                                          <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="dropdown-item badge t_withdraw_status" data-msg="You are changing this withdraw Request to pending!." data-url="'.route("admin.vendor.payment.withdraw.status",[$data->id,'pending']).'" href="javascript:void(0)"> Pending</a>
                                            <a class="dropdown-item badge t_withdraw_status" data-msg="You are about to accept this withdraw Request!." data-url="'.route("admin.vendor.payment.withdraw.status",[$data->id,'completed']).'" href="javascript:void(0)"> Completed</a>
                                          </div>
                                        </div>';
                                    }
                                    else{

                                        return '<div class="dropdown">
                                          <button type="button" class="badge badge-danger dropdown-toggle" id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            Pending
                                          </button>
                                          <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">
                                             <a class="dropdown-item badge t_withdraw_status" data-msg="You are about to accept this withdraw Request!." data-url="'.route("admin.vendor.payment.withdraw.status",[$data->id,'completed']).'" href="javascript:void(0)"> Completed</a>
                                            <a class="dropdown-item badge t_withdraw_status"  data-msg="You are about to reject this withdraw Request!." data-url="'.route("admin.vendor.payment.withdraw.status",[$data->id,'rejected']).'" href="javascript:void(0)"> Rejected</a>
                                          </div>
                                        </div>';
                                    }
                                })
                                ->addColumn('action', function(PaymentWithdraw $data) {
                                    return  '<div class="dropdown">
                                              <button type="button" class="badge badge-dark dropdown-toggle" id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Actions
                                              </button>
                                          <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="dropdown-item" href="'.route("admin.vendor.payment.withdraw.detail.show",$data->id).'"><i class="mdi mdi-eye"></i> Details</a>
                                          </div>
                                        </div>';
                                })
                                ->rawColumns(['name','status','action'])
                                ->toJson(); //--- Returning Json Data To Client Sid
    }
    public function index()
    {
        $withdraws = PaymentWithdraw::latest()->get();
      return view('admin.paymentwithdraw.index',compact('withdraws'));
    }
    public function show($id)
    {
        $withdraw = PaymentWithdraw::findOrFail($id);
        return view('admin.paymentwithdraw.show',compact('withdraw'));
    }
    public function status($id,$status)
    {
        if (!in_array($status, ['pending','completed','rejected'])) {
           return response()->json([
            'msg'=>'danger',
            'danger'=>'Opps! Somethinh Wend Wrong!',
           ]);
        }
        $withdraw = PaymentWithdraw::findOrFail($id);
        $withdraw->status = $status;
        $withdraw->save();
        return response()->json([
            'msg'=>'success',
            'success'=>'Withdraw Status Has been Changed to '.ucfirst($status),
       ]);
    }
}
