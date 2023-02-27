
<form id="orderstatusform" action="{{route('admin.orders.change_status',$order->id)}}" method="POST">
	<input type="hidden" name="_token" id="Newtoken" value="{{csrf_token()}}">
	<div class="form-group">
		<label>{{__('Payment Status')}}</label>
		<select class="form-control" id="payment_status" name="payment_status">
			<option value="1" <?=($order->payment_status == 1) ? 'selected="selected"' : '' ?> >{{__('Paid')}}</option>
			<option value="0" <?=($order->payment_status != 1) ? 'selected="selected"' : '' ?> >{{__('UnPaid')}}</option>
		</select>
	</div>
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
		<button type="submit" class="btn btn-dark">{{__('Save')}}</button>
	</div>
</form>