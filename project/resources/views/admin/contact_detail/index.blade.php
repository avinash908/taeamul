@extends('layouts.admin.app')
@section('content')
<div class="py-4"></div>
<div class="container bg-white rounded-pill p-5">
	<h1>{{__('Contact Us Page Details')}}</h1>
	<div class="form-content  p-3">
		<form method="post" action="{{route('admin.contact_details.update')}}">
			@if ($errors->any())
		        <ul class="alert alert-danger">
		            @foreach($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    @endif
			@csrf
			<div class="form-group">
				<label >{{__('Contact Email')}}</label>
				<input type="text" class="form-control rounded-0" value="{{$detail->email}}" name="email" placeholder="eg: abc@xyz.com">
			</div>
			<div class="form-group">
				<label >{{__('Contact Phone')}}</label>
				<input type="text" class="form-control rounded-0" value="{{$detail->phone}}" name="phone" placeholder="eg: 00011188801">
			</div>
			<div class="form-group">
				<label >{{__('Address')}}</label>
				<textarea  class="form-control" name="address" placeholder="eg: 17 Princess Road, Saudi, Jeddah">{{ $detail->address }}</textarea>
			</div>
			<div class="form-group">
				<label >{{__('Contact Info')}}</label>
				<textarea class="form-control" name="info" placeholder="eg: Lorem ipsum is dummy text... ">{!! $detail->info !!}</textarea>
			</div>
			<div class="form-group">
				<label >{{__('Facebook')}}</label>
				<input type="text" class="form-control rounded-0" value="{{$detail->facebook}}" name="facebook" placeholder="eg: https://www.facebook.com/username">
			</div>
			<div class="form-group">
				<label >{{__('Twitter')}}</label>
				<input type="text" class="form-control rounded-0" value="{{$detail->twitter}}" name="twitter" placeholder="eg: https://twitter.com/username">
			</div>
			<div class="form-group">
				<label >{{__('Youtube')}}</label>
				<input type="text" class="form-control rounded-0" value="{{$detail->youtube}}" name="youtube" placeholder="eg: https://www.youtube.com/channel">
			</div>
			<div class="form-group">
				<label >{{__('Instagram')}}</label>
				<input type="text" class="form-control rounded-0" value="{{$detail->instagram}}" name="instagram" placeholder="eg: https://www.instagram.com/username">
			</div>
			<div class="form-group">
				<label >{{__('Pinterest')}}</label>
				<input type="text" class="form-control rounded-0" value="{{$detail->pinterest}}" name="pinterest" placeholder="eg: https://www.pinterest.com/username">
			</div>
			<div class="form-group">
				<label >{{__('Gmail')}}</label>
				<input type="text" class="form-control rounded-0" value="{{$detail->gmail}}" name="gmail" placeholder="eg: jhondoe@gmail.com">
			</div>
			<div class="form-group">
				<label >{{__('Whatsapp')}}</label>
				<input type="text" class="form-control rounded-0" value="{{$detail->whatsapp}}" name="whatsapp" placeholder="eg: +92 0000000020">
			</div>
			<div class="form-group">
				<label >{{__('Tumblr')}}</label>
				<input type="text" class="form-control rounded-0" value="{{$detail->tumblr}}" name="tumblr" placeholder="eg: https://tumblr.com/username">
			</div>
			<button type="submit" class="btn btn-primary rounded-0 float-right">{{__('Save')}}</button>
		</form>
	</div>
</div>
@endsection