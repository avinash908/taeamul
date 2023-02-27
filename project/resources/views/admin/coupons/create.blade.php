@extends('layouts.admin.app')
@section('content')
<div class="content p-5 bg-white">
	<div>
		<h2 class="text-center">{{__('Create Coupon')}}</h2>
		<form action="{{route('coupon.store')}}" method="POST" class="p-5">
			@csrf
			<div class="form-group">
				<label for="code">{{__('Code')}} :</label>
				<input type="text" class="form-control" placeholder="Write Coupon Code" name="code" required>
			</div>
			<div class="form-group">
				<label for="price">{{__('Price')}} :</label>
				<input type="number" class="form-control" placeholder="Write price" name="price" required>
			</div>
			<div class="form-group">
				<label for="times">{{__('Times')}} :</label>
				<input type="number" class="form-control" placeholder="Write times" name="times" required>
			</div>
			<div class="form-group">
				<label for="code">{{__('Start Date')}} :</label>
				<input type="date" class="form-control" placeholder="Write Coupon Code" name="strDate" required>
			</div>
			<div class="form-group">
				<label for="code">{{__('End Date')}} :</label>
				<input type="date" class="form-control" placeholder="Write Coupon Code" name="endDate" required>
			</div>
			<div class="form-group text-right">
				<button type="submit" class="btn btn-primary" >{{__('Create')}}</button>
			</div>
		</form>
	</div>
</div>

@endsection