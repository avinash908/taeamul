
<form id="orderstatusform" action="{{route('v-orders.change_status',$order->order_number)}}" method="POST">
	<input type="hidden" name="_token" id="Newtoken" value="{{csrf_token()}}">
	<div class="form-group">
		<label>{{__('Order Status')}}</label>
		<select class="form-control" id="order_status" name="status">	
			<option value="pending" <?=($order->status == 'pending') ? 'selected="selected"' : '' ?> >{{__('Pending')}}</option>
			<option value="processing" <?=($order->status == 'processing') ? 'selected="selected"' : '' ?> >{{__('Processing')}}</option>
			<option value="completed" <?=($order->status == 'completed') ? 'selected="selected"' : '' ?> >{{__('Completed')}}</option>
			<option value="declined" <?=($order->status == 'declined') ? 'selected="selected"' : '' ?> >{{__('Declined')}}</option>
		</select>
	</div>
	<div class="text-center">
		<button type="submit" class="btn btn-dark">Save</button>
	</div>
</form>