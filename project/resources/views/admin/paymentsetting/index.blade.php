@extends('layouts.admin.app')
@section('content')
<div class="py-4"></div>
<div class="container bg-white rounded-pill p-5">
	<h1>{{__('Payment Settings')}}</h1>
	<div class="form-content  p-3">
		<form method="post" action="{{route('admin.payment.settings.update')}}">
			@if ($errors->any())
		        <ul class="alert alert-danger">
		            @foreach($errors->all() as $error)
		                <li>{{ __($error) }}</li>
		            @endforeach
		        </ul>
		    @endif
			@csrf
			<div class="form-group">
				<label class="lead">{{__('Currency Format')}}</label>
				<input type="text" class="form-control rounded-0" value="{{$payment_st->currency_format}}" placeholder="eg: Sr" name="currency_format" required>
			</div>
			<div class="form-group">
				<label class="lead">{{__('Withdraw Fee')}}</label>
				<input type="number" class="form-control rounded-0" value="{{$payment_st->withdraw_fee}}"  min="0" placeholder="eg: 109" name="withdraw_fee" required>
			</div>
			<div class="form-group">
				<label class="lead">{{__('Commission Charges')}}</label>
				<input type="number" class="form-control rounded-0" value="{{$payment_st->commission_charges}}" min="0" placeholder="eg: 10" name="commission_charges" required>
			</div>
			<div class="form-group">
				<label class="lead">{{__('Charge Commission In (Percentage) or (Fixed Amount)')}}</label>
				<select name="charge_in" class="form-control" required>
					<option value="1" {{($payment_st->charge_in_percentage == 1) ? 'selected' : ''}} >{{__('Percentage')}}</option>
					<option value="0" {{($payment_st->charge_in_percentage == 0) ? 'selected' : ''}}>{{__('Fixed')}}</option>
				</select>
			</div>
			<button type="submit" class="btn btn-primary rounded-0 float-right">{{__('UPDATE')}}</button>
		</form>
	</div>
</div>
@endsection