<div class="Dashboard">
	<ul class="list-unstyled mleft">
		<li class="list-item"><b>{{__('Name')}} &nbsp;:</b>&nbsp;{{__(ucfirst(Auth::user()->name))}}</li>
		<li class="list-item"><b>{{__('Email')}} &nbsp;:</b>&nbsp;{{Auth::user()->email}}</li>
		<li class="list-item"><b>{{__('Phone')}} &nbsp;:</b>&nbsp;{{Auth::user()->phone}}</li>
	</ul>
	<div class="divider" style="margin: 10rem 0px;"></div>
	<div class="table-responsive">
		<table class="table table-striped table-hover table-bordered">
			<thead>
				<tr>
					<th>#</th>
				<th>{{__('Order')}}</th>
				<th>{{__('Date')}}</th>
				<th>{{__('Order Totals')}}</th>
				<th>{{__('Order Status')}}</th>
				<th>{{__('View')}}</th>
				</tr>
			</thead>
			<tbody>
			@php
			$sno = 1;
			@endphp
			@foreach($order as $row)
			<tr>
				<td>{{$sno++}}</td>
				<td>{{$row->order_number}}</td>
				<td>{{$row->created_at->format('d M Y')}}</td>
				<td>Sr.{{$row->total_amount}}</td>
				<td><span class="{{$row->status}}">{{$row->status}}</span></td>
				<td><a  href="javascript:void(0)" data-url="{{url('/my-account/order',$row->order_number)}}" class="viewOrder button alt">{{__('View')}}</a></td>
			</tr>
			@endforeach
		</tbody>
		</table>
	</div>
</div>