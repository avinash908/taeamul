@extends('layouts.admin.app')
@section('content')
<div class="content p-5 bg-white">
	<div>
		<h2 class="text-center">{{__('Create Subscriber')}}</h2>
		 @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="list-unstyled">
            @foreach ($errors->all() as $error)
                <li>{{ __($error) }}</li>
            @endforeach
        </ul>
    </div>
  @endif
		<form action="{{route('subscriber.store')}}" method="POST" class="p-5">
			@csrf
			<div class="form-group">
				<label for="email">{{__('Email')}} :</label>
				<input type="text" class="form-control" placeholder="Write Coupon Code" name="email" required>
			</div>
			<div class="form-group">
				<label for="checkMail"><input type="checkbox" placeholder="Write Coupon Code" name="checkMail">{{__('Email With Coupon')}}</label>
			</div>
			<div class="form-group text-right">
				<button type="submit" class="btn btn-primary" >{{__('Create')}}</button>
			</div>
		</form>
	</div>
</div>

@endsection