<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:can manage orders']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatables($status)
    {
        $array = array("pending","processing","completed","declined");
        if (in_array($status,$array))
        {
            $datas = Order::where('status','=',$status)->get();
        }
        else{
          $datas = Order::orderBy('id','desc')->get();  
        }
         return Datatables::of($datas)
                            ->addColumn('action', function(Order $data) {
                                return '<div class="dropdown">
                          <button type="button" class="badge badge-dark dropdown-toggle" id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <h6 class="dropdown-header"></h6>
                            <a class="dropdown-item" href="'.route('admin.orders.show',$data->id).'"><i class="mdi mdi-eye"></i> Details</a>
                            <a class="dropdown-item t_status" data-url="'.route('admin.orders.get_status',$data->id).'" href="javascript::void(0);"><i class="mdi mdi-cart"></i> Delivery Status</a>
                          </div>
                        </div>';
                            })->addColumn('order_status', function(Order $data) {
                                return '<div class="badge order-'.$data->status.' badge-fw">'.ucwords($data->status).'</div>';
                            })
                            ->rawColumns(['action','order_status'])
                            ->toJson(); 
    }

    public function index($status)
    {
        $array = array("all","pending","processing","completed","declined");
        if (!in_array($status,$array))
        {
            return abort(404);
        }
        return view('admin.order.index',compact('status'));
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.order.show',compact('order'));
    }

    public function invoice($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.order.invoice',compact('order'));
    }
    public function getStatus($id)
    {
        $order = Order::findOrFail($id);
        $view = view('admin.order.ajax.status',compact('order'))->render();
        return response()->json(['html'=>$view]); 
    }
    public function changeStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
            $order->update([
                'status'=>$request->input('order_status'),
                'payment_status'=>$request->input('payment_status'),
            ]);
        if ($order->shop_id != null && $order->payment_status == 1) {
            $new_amount = $order->shop->WithCommission($order->total_amount);
            $order->shop->current_balance = $order->shop->current_balance + $new_amount;
            $order->shop->save();
        }
        return response()->json(['success' => 'Order Status has been Changed!']);
    }
    public function send_invoice($orderid)
    {
        $order = Order::findOrFail($orderid);

        $pathToImage = base_path('../assets/images/screenshots/abc.jpg');
        ;
        return redirect()->route()->with('success','Invoice has been sent!');
    }
}
