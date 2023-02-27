@extends('layouts.vendor.app')
@section('content')
<div class="row">
  <div class="col-lg-12" >
      <div class="card px-2" id="invoice">
          <div class="card-body">
              <div class="container-fluid">
              	<h1 class="text-left my-2">{{__(env('APP_NAME'))}}</h1>
                <h3 class="text-right my-2">{{__('Invoice')}}&nbsp;&nbsp; #{{sprintf("%'.06d", $vorder->order->id)}}</h3>
                <hr>
              </div>
              <div class="container-fluid d-flex justify-content-between">
                <div class="col-lg-3 pl-0">
                  <p class="mt-5 mb-2"><b>{{__('Order Details')}}</b></p>
                  <p><b>{{__('Order Number')}} :</b> {{$vorder->order_number}}</p>
                  <p><b>{{__('Order Date ')}}:</b> {{$vorder->order->created_at->format('d-M-Y')}}</p>
                  <p><b>{{__('Payment Method')}} :</b> {{ucwords($vorder->order->payment_method)}}</p>
                </div>
                <div class="col-lg-3 pr-0">
                  <p class="mt-5 mb-2 text-right"><b>{{__('Shipping Address')}}</b></p>
                  @if($vorder->order->ship_to)
                  <p class="text-right"><b>{{__('Customer Name ')}}:</b> {{ucwords($vorder->order->shipping_name)}}</p>
                  <p class="text-right"><b>{{__('Address')}} :</b> {{ucwords($vorder->order->shipping_address)}}</p>
                  <p class="text-right"><b>{{__('City')}} :</b> {{ucwords($vorder->order->shipping_city)}}</p>
                  @else
                  <p class="text-right"><b>{{__('Customer Name')}} :</b> {{ucwords($vorder->order->customer_name)}}</p>
                  <p class="text-right"><b>{{__('Address')}} :</b> {{ucwords($vorder->order->customer_address)}}</p>
                  <p class="text-right"><b>{{__('City')}} :</b> {{ucwords($vorder->order->customer_city)}}</p>
                  @endif
                </div>
              </div>
              <div class="container-fluid d-flex justify-content-between">
                <div class="col-lg-3 pl-0">
                <p class="mt-5 mb-2"><b>{{__('Billing Details')}}</b></p>
                  <p ><b>{{__('Customer Name')}} :</b> {{ucwords($vorder->order->customer_name)}}</p>
                  <p ><b>{{__('Address')}} :</b> {{ucwords($vorder->order->customer_address)}}</p>
                  <p ><b>{{__('City')}} :</b> {{ucwords($vorder->order->customer_city)}}</p>
                  @if($vorder->order->payment_status == 1)
                  <p class="mb-0 mt-5">Payment Paid</p>
                  <p >Due Date : {{$vorder->order->created_at->format('d M Y')}}</p>
                  @endif
                </div>
              </div>
              <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                <div class="table-responsive w-100">
                    <table class="table">
                      <thead>
                        <tr class="bg-dark text-white">
                            <th>#</th>
                            <th>{{__('Product')}}</th>
                            <th class="text-right">{{__('Details')}}</th>
                            <th class="text-right">{{__('Total')}}</th>
                          </tr>
                      </thead>
                      <tbody>
                      	<?php 
                      		$count = 1;
                      	?>
                        @foreach($items as $item)
                        <tr class="text-right">
                          <td class="text-left">{{$count++}}</td>
                          <td class="text-left">{{ucwords($item->product->name)}}</td>
                          <td>
	                          <span style="display: flex;">
		                          <ul class="list-unstyled">
		                            <li>    
		                              <span style="font-weight: bold">{{__('Quantity')}}&nbsp;:&nbsp;</span>{{$item->quantity}}
		                            </li>
		                            <li>    
		                              <span style="font-weight: bold">{{__('Price')}}&nbsp;:&nbsp;</span>Sr. {{number_format($item->price,2)}}
		                            </li>
		                            @if($item->color)
		                            <li style="display: flex;">
		                               <span style="font-weight: bold">{{__('Color')}}&nbsp;:&nbsp;</span>
		                            <a href="javascript:void(0)" class="atag-color-section">
		                            <div style="background-color: <?=$item->color?>;padding:10px 10px ;">
		                            </div>
		                            </a>
		                            </li>
		                            @endif
		                            @if($item->size)

		                            <li>
		                                
		                             <a href="javascript:void(0)" class="atag-color-section">
		                            <div>
		                               <span style="font-weight: bold">{{__('Size')}}&nbsp;:&nbsp;</span>{{$item->size}}
		                            </div>
		                            </a>
		                            </li>
		                            @endif
		                          </ul>
		                      </span>
                        </td>
                          <td>Sr. {{ number_format($item->total_price,2)}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
              </div>
              <?php
                  $shopId = auth()->user()->shop->id;
                  $vos = $vorder->order->vendororders()->where('shop_id','=',$shopId)->get();
                  $tp = 0;
                  foreach ($vos as $vo) {
                      $tp += $vo->total_price;
                  }
                ?>
              <div class="container-fluid mt-5 w-100">
                <h4 class="text-right mb-5">{{__('Total')}} : Sr. {{number_format($tp,2)}}</h4>
                <hr>
              </div>
              <div class="container-fluid w-100">
                <a href="javascript:void(0)" class="btn btn-primary avoid-this-for-print print_btn float-right mt-4 ml-2"><i class="mdi mdi-printer mr-1"></i>{{__('Print')}}</a>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
@section('javascript')
<script type="text/javascript">
	$(document).on('click','.print_btn',function(){
		$("#invoice").print({
			noPrintSelector : ".avoid-this-for-print",
		});	
	});
</script>
@endsection