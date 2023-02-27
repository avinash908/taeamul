<div class="table-responsive">
	<h3 style="padding: 15px">{{__('Orders')}}</h3>
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
				<td>Sr.{{number_format($row->total_amount,2)}}</td>
				<td><span class="{{$row->status}}">{{$row->status}}</span></td>
				<td><a  href="javascript:void(0)" data-url="{{url('/my-account/order',$row->order_number)}}" class="viewOrder button alt">{{__('View')}}</a></td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>