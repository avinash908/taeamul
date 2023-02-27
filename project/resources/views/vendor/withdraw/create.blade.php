@extends('layouts.vendor.app')
@section('content')
<div class="py-4"></div>
<div class="container bg-white rounded-pill p-5">
	<h1>{{__('Withdraw Now')}}</h1>
	<div class="form-content  p-3">
		<form method="post" action="{{route('v-withdraw.store')}}">
			@if ($errors->any())
		        <ul class="alert alert-danger">
		            @foreach($errors->all() as $error)
		                <li>{{ __($error) }}</li>
		            @endforeach
		        </ul>
		    @endif
		    @if(session()->has('message'))
		    	<div class="alert alert-danger">
		    		{{__(session()->get('message'))}}
		    	</div>
		    @endif
			@csrf
			<div class="form-group">
				<label >{{__('Withdraw Amount')}}*</label>
				<input type="number" class="form-control rounded-0" min="1000" value="{{old('amount')}}" placeholder="eg: 1000" name="amount" required>
			</div>
			<div class="form-group">
				<label >{{__('IBAN/Account No')}}*</label>
				<input type="text" class="form-control rounded-0" value="{{old('iban')}}" name="iban" required>
			</div>
			<div class="form-group">
				<label >{{__('Account Name')}}*</label>
				<input type="text" class="form-control rounded-0" value="{{old('acc_name')}}"  name="acc_name" required>
			</div>
			<div class="form-group">
				<label >{{__('Account Email')}}*</label>
				<input type="email" class="form-control rounded-0" value="{{old('acc_email')}}"  name="acc_email" required>
			</div>
			<div class="form-group">
				<label >{{__('Address')}}*</label>
				<textarea name="address" class="form-control" required>{{old('address')}}</textarea>
			</div>
			<div class="form-group">
				<label >{{__('Swift Code')}}*</label>
				<input type="text" class="form-control rounded-0" value="{{old('swift')}}"  name="swift" required>
			</div>
			<div class="form-group">
				<label >{{__('Reference')}} <small>({{__('optional')}})</small></label>
				<textarea name="reference" class="form-control">{{old('reference')}}</textarea>
			</div>
			@if($ps = App\PaymentSetting::find(1))
			 	Sr. {{$ps->withdraw_fee}} {{__('Withdraw fee will be deduct from your account')}}
			@endif
			<button type="submit" class="btn btn-primary rounded-0 float-right">{{__('Submit')}}</button>
		</form>
	</div>
</div>
@endsection