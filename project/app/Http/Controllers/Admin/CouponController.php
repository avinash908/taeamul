<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subscriber;
use App\Coupon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CouponNotification;
use App\Mail\CouponMail;

use DataTables;


class CouponController extends Controller
{
   public function index()
   {
       return view('admin.coupons.index');
   }
    public function create()
   {
       return view('admin.coupons.create');
   }
    public function edit($id)
   {
        $coupon = Coupon::findOrFail($id);
       return view('admin.coupons.edit',compact('coupon'));
   }
   public function update(Request $request,$id)
   {
        $validate = $request->validate([
        'code'=>'required|',
        'price'=>'required',
        'times'=>'required',
        'strDate'=>'required',
        'endDate'=>'required',
       ]);
        if ($validate) {
            Coupon::where('id',$id)->update([
            'code'=>$request->input('code'),
            'price'=>$request->input('price'),
            'times'=>$request->input('times'),
            'start_date'=>$request->input('strDate'),
            'end_date'=>$request->input('endDate'),
            ]);
            return redirect()->route('coupon.index')->with('success','Coupon Has Been Updated !');
        }
            return redirect()->back()->with('danger','Coupon Cannot Be Updated !');
   }
   public function store(Request $request)
   {
       $validate = $request->validate([
        'code'=>'required|unique:coupons,code',
        'price'=>'required',
        'times'=>'required',
        'strDate'=>'required',
        'endDate'=>'required',
       ]);
       if ($validate) {
           Coupon::create([
            'code'=>$request->input('code'),
            'price'=>$request->input('price'),
            'times'=>$request->input('times'),
            'used'=>null,
            'start_date'=>$request->input('strDate'),
            'end_date'=>$request->input('endDate'),
           ]);
            return redirect()->route('coupon.index')->with('success','Coupon Has Been Created !');

       }
        return redirect()->back()->with('danger','Coupon Cannot Be Created !');

   }
    public function destroy(Request $request,$id)
    {
       $Coupon = Coupon::findOrFail($id);
       $Coupon->delete();
       if ($request->ajax()) {
           return response()->json([
            'msg'=>'success',
            'success'=>'Coupon has been deleted!',
        ]);
       }
        return redirect()->route('coupon.index')->with('Coupon has been deleted!');
    }
   public function couponDatatable()
   {
        $datas = Coupon::orderBy('id','desc')->get();
             return Datatables::of($datas)
                        ->addColumn('code', function(Coupon $data) {
                                return $data->code;
                            })
                         ->addColumn('price', function(Coupon $data) {
                                return $data->price;
                            })
                         ->addColumn('times', function(Coupon $data) {
                                return $data->times;
                            })
                         ->addColumn('used', function(Coupon $data) {
                                return $data->used;
                            })
                            ->addColumn('status', function(Coupon $data) {
                                 if($data->status != 1){
                                return '<div class="dropdown">
                                      <button type="button" class="badge badge-dark dropdown-toggle" id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        Deactivated
                                      </button>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <a class="dropdown-item badge t_active" data-url="'.route("admin.coupon.active",$data->id).'" href="javascript:void(0)"><i class="mdi mdi-eye"></i> Activate</a>
                                      </div>
                                    </div>';
                                }else{

                                    return '<div class="dropdown">
                                      <button type="button" class="badge badge-success dropdown-toggle" id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        Activated
                                      </button>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <a class="dropdown-item badge t_deactive" data-url="'.route("admin.coupon.deactive",$data->id).'" href="javascript:void(0)"><i class="mdi mdi-eye-off"></i> Deactivate</a>
                                      </div>
                                    </div>';
                                }
                            })
                            ->addColumn('end_date', function(Coupon $data) {
                                return $data->end_date;
                            })
                            ->addColumn('created_at', function(Coupon $data) {
                                return $data->created_at->format('D M Y');
                            })
                            ->addColumn('action', function(Coupon $data) {
                                return '<div class="dropdown">
                          <button type="button" class="btn btn-dark dropdown-toggle" id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <h6 class="dropdown-header"></h6>
                            <a class="dropdown-item" href="'.route('coupon.edit',$data->id).'"><i class="mdi mdi-pencil"></i> Edit</a>
                            <a class="dropdown-item t_delete" data-url="'.route('coupon.destroy',$data->id).'" href="javascript:void(0)"><i class="mdi mdi-delete"></i> Delete</a>
                          </div>
                        </div>';
                            })
                    ->rawColumns(['code','price','times','used','status','end_date','action'])
                ->toJson();
   }


    public function active($id)
    {
        $Coupon = Coupon::findOrFail($id);
        $Coupon->status = 1;
        $Coupon->save();
        return response()->json(['success'=>'Coupon has been activated!']);
    }

    public function deactive($id)
    {
        $Coupon = Coupon::findOrFail($id);
        $Coupon->status = 0;
        $Coupon->save();
        return response()->json(['success'=>'Coupon has been deactivated!']);
    }
}
