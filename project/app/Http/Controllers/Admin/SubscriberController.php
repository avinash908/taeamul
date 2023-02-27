<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subscriber;
use App\Coupon;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CouponNotification;
use DataTables;
class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.subscriber.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subscriber.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$validate = $request->validate([
    		'email' => 'required|email',
    	]);
    	if (!$validate) {
    		return redirect()->back()->json(['error' => $validate->errors()->all()]);
    	}
    	if (!$request->input('checkMail')) {
	    	$input = $request->input('email');
    		$q = Subscriber::where('email',$input)->first();
		    	if ($q) {
	    			return redirect()->route('subscriber.create')->with('danger','This Email Is Already Registered');
	    		}
    		$subscriber = Subscriber::create(['email' => $input]);
    		return redirect()->route('subscriber.index')->with('success','Subscriber Has Been Created');
    	}
    	$input = $request->input('email');
    	$q = Subscriber::where('email',$input)->first();
    	if ($q) {
    		return redirect()->route('subscriber.create')->with('danger','This Email Is Already Registered');
    	}else{
    		$subscriber = Subscriber::create(['email' => $input]);
    		$data = Coupon::orderBy('id','desc')->firstOrFail();

    		$data->used = $data->used + 1;

    		$data->save();

    		$coupon = [
    			'coupon'=>$data->code,
    			'endDate'=>$data->end_date,
    		];
    		if ($subscriber) {
    			$subscriber->notify(new CouponNotification($coupon));
    			// Notification::route('mail', $input)->notify(new CouponNotification($coupon));
    			return redirect()->route('subscriber.index')->with('success','Subscriber Has Been Created !');
    		}
    	}
    }

   
   public function destroy(Request $request, $id)
    {
       $user = Subscriber::findOrFail($id)->delete();
       if ($request->ajax()) {
            return response()->json([
                'msg'     => 'success',
                'success' => 'Subscriber has been Deleted!'
            ]);
        }
       return redirect()->back()->with('success','Subscriber has been deleted!');
    }


    public function datatable()
    {
    	 $datas = Subscriber::orderBy('id','DESC')->get();
    	 $sno = 1;
             return Datatables::of($datas)
                            ->addColumn('email', function(Subscriber $data) {
                                return $data->email;
                            })
                            ->addColumn('created_at', function(Subscriber $data) {
                                return $data->created_at->format('Y M D');
                            })
                            ->addColumn('action', function(Subscriber $data) {
                                return '<a class="dropdown-item t_delete" href="javascript:void(0)" data-url='.route('subscriber.destroy',$data->id).' ><i class="mdi mdi-delete"></i> Delete</a>';
                            })
                    ->rawColumns(['email','created_at','action'])
                ->toJson();
    }


}
