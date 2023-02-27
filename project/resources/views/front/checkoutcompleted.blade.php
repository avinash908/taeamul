@extends('layouts.front.app')
@section('title',env('APP_Name') . ' - Checkout Completed' )
@section('content')
<style type="text/css">
	.p-tag{
		font-size: 1rem;
	}
</style>
<div class="content">
	<div class="container">
		<div class="row card"  style="padding: 50px;margin-top:20px;box-shadow: 0 0 2px 3px #00000038;">
			<div class="card-body">
				<div style="text-align: center;">
				<h2 style="font-weight: bold">{{__("THANK YOU FOR YOUR PURCHASE")}}</h2>
				<h5>{{__('We"ll Email you order confirmation with details and tracking info.')}}</h5>
				<a href="{{url('/')}}">{{__('Go Back To Home Page')}}</a>
				</div>
				<div style="padding: 2rem 0px"></div>
				<div class="col-lg-6">
					<h4 style="font-weight: bold">{{__('Order')}}# {{$order->order_number}}</h4>
					<p class="p-tag">{{__('Order Date')}} {{$order->created_at->format('d-m-Y')}}</p>
					<div style="padding: 1.5rem 0px"></div>
					<h4 style="font-weight: bold">{{__('Shipping Address')}}</h4>
					<ul class="list-unstyled">
						@if($order->ship_to)
						<li class="p-tag">{{__('Name')}} : {{__($order->shipping_name)}}</li>
						<li class="p-tag">{{__('Email')}} : {{$order->shipping_email}}</li>
						<li class="p-tag">{{__('Phone')}} : {{$order->shipping_phone}}</li>
						<li class="p-tag">{{__('Address')}} : {{__($order->shipping_address)}} &nbsp; {{__($order->customer_city)}} &nbsp; {{__($order->shipping_state)}}</li>
						<li class="p-tag">{{__('Postal Code')}} : {{$order->shipping_zip}}</li>
						@else
						<li class="p-tag">{{__('Name')}} : {{__($order->customer_name)}}</li>
						<li class="p-tag">{{__('Email')}} : {{$order->customer_email}}</li>
						<li class="p-tag">{{__('Phone')}} : {{$order->customer_phone}}</li>
						<li class="p-tag">{{__('Address')}} : {{__($order->customer_address)}} &nbsp; {{__($order->customer_city)}} &nbsp; {{__($order->customer_state)}}</li>
						<li class="p-tag">{{__('Postal Code')}} : {{$order->customer_zip}}</li>
						@endif
					</ul>
					<div style="padding: 1.5rem 0px"></div>
					<h4 style="font-weight: bold">{{__('Billing Address')}}</h4>
					<ul class="list-unstyled">
						<li class="p-tag">{{__('Name')}} : {{__($order->customer_name)}}</li>
						<li class="p-tag">{{__('Email')}} : {{$order->customer_email}}</li>
						<li class="p-tag">{{__('Phone')}} : {{$order->customer_phone}}</li>
						<li class="p-tag">{{__('Address')}} : {{__($order->customer_address)}} &nbsp; {{__($order->customer_city)}} &nbsp; {{__($order->customer_state)}}</li>
						<li class="p-tag">{{__('Postal Code')}} : {{$order->customer_zip}}</li>
					</ul>
					<div style="padding: 1.5rem 0px"></div>
				</div>
					<div style="padding: 2.5rem 0px"></div>

				<div class="col-lg-6">
					<div style="padding: 2.5rem 0px"></div>
					<h5 style="font-weight: bold">{{__('Payment Information')}}</h5>
					<p  class="p-tag">{{__('Total Amount')}} : Sr. {{number_format($order->total_amount,2)}}</p>
					<p  class="p-tag">{{__('Payment Method')}} : {{__($order->payment_method)}}</p>
					<p  class="p-tag">{{__('Payment Status')}} : {{($order->payment_status == 1) ? 'Paid' : 'Unpaid' }}</p>
				</div>
				<div class="col-lg-12">
					<div class="table-responsive">
						<table  class="table table-bordered">
							<thead>
								<tr>
									
								<th>#</th>
								<th>{{__('Name')}}</th>
								<th>{{__('Details')}}</th>
								<th>{{__('Price')}}</th>
								<th>{{__('Total')}}</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$count = 1;
								?>
								@foreach($order->items as $item)
								<tr>
									<td>{{$count++}}</td>
									<td>{{__(ucwords($item->product->name))}}</td>
									<td>
										<span style="display: flex;">
							            <ul class="list-unstyled">
							            	<li>    
								              <span style="font-weight: bold">{{__('Quantity')}}&nbsp;:&nbsp;</span>{{$item->quantity}}
								            </li>
								            @if($item->color)
								            <li style="display: flex;">
								               <span style="font-weight: bold">Color&nbsp;:&nbsp;</span>
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
								               <span style="font-weight: bold">{{__("Size")}} &nbsp;:&nbsp;</span>{{$item->size}}
								            </div>
								            </a>
								            </li>
								            @endif
							            </ul>
							        </span>
									</td>
									<td>{{number_format($item->price,2)}}</td>
									<td>{{number_format($item->total_price,2)}}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection