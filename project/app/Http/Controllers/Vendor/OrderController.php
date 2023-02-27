<?php

namespace App\Http\Controllers\Vendor;

use Auth;
use App\Order;
use App\VendorOrder;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class OrderController extends Controller
{
    public function datatables()
    {
        $shop_id = Auth::user()->shop->id;

        $orders = VendorOrder::where('shop_id','=',$shop_id)->orderBy('id','desc')->get();
        $collection = collect($orders); 
        $datas = $collection->unique('order_number');

         return Datatables::of($datas)
                            ->addColumn('action', function(VendorOrder $data) {
                                return '<div class="dropdown">
                          <button type="button" class="badge badge-dark dropdown-toggle" id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <h6 class="dropdown-header"></h6>
                            <a class="dropdown-item" href="'.route('v-orders.show',$data->order->id).'"><i class="mdi mdi-eye"></i> Details</a>
                            <a class="dropdown-item t_status" data-url="'.route("v-orders.status",$data->id).'" href="javascript::void(0);"><i class="mdi mdi-cart"></i> Delivery Status</a>
                          </div>
                        </div>';
                            })->addColumn('order_status', function(VendorOrder $data) {
                                return '<div class="badge order-'.$data->status.' badge-fw">'.ucwords($data->status).'</div>';
                            })
                            ->addColumn('customer_email', function(VendorOrder $data) {
                                return $data->order->customer_email;
                            })
                            ->addColumn('total_amount', function(VendorOrder $data) {
                                return number_format($data->order->total);
                            })
                            ->addColumn('total_qty', function(VendorOrder $data) {
                                $shopId = auth()->user()->shop->id;
                                $vos = $data->order->vendororders()->where('shop_id','=',$shopId)->get();
                                $qt = 0;
                                foreach ($vos as $vo) {
                                    $qt += $vo->quantity;
                                }
                                return $qt;
                            })
                            ->addColumn('total_amount', function(VendorOrder $data) {
                                $shopId = auth()->user()->shop->id;
                                $vos = $data->order->vendororders()->where('shop_id','=',$shopId)->get();
                                $tp = 0;
                                foreach ($vos as $vo) {
                                    $tp += $vo->total_price;
                                }
                                return $tp;
                            })
                            ->rawColumns(['action','total_qty','total_amount','order_status'])
                            ->toJson(); 
    }

    public function index()
    {
        return view('vendor.order.index');
    }

    public function show($id)
    {
        $shopId = Auth::user()->shop->id;
        $vorder = Auth::user()->shop->orders()->findOrFail($id);
        $items = $vorder->order->vendororders()->where('shop_id','=',$shopId)->get();
        return view('vendor.order.show',compact('vorder','items'));
    }

    public function invoice($id)
    {
        $shopId = Auth::user()->shop->id;
        $vorder = Auth::user()->shop->orders()->findOrFail($id);
        $items = $vorder->order->vendororders()->where('shop_id','=',$shopId)->get();
        return view('vendor.order.invoice',compact('vorder','items'));
    }
    public function getStatus($id)
    {
        $order = Auth::user()->shop->orders()->findOrFail($id);
        $view = view('vendor.order.ajax.status',compact('order'))->render();
        return response()->json(['html'=>$view]); 
    }
    public function changeStatus(Request $request, $num)
    {
        $orders = Auth::user()->shop->orders()->where('order_number','=',$num)->get();

        foreach ($orders as $order) {
            $order->status = $request->input('order_status');
            $order->save(); 
        }

        // if ($order->payment_status == 1) {
        //     $new_amount = Auth::user()->shop->WithCommission($order->total_amount);
        //     Auth::user()->shop->current_balance = Auth::user()->shop->current_balance + $new_amount;
        //     Auth::user()->shop->save();
        // }
        return response()->json(['success' => 'Order Status has been Changed!']);
    }
}
