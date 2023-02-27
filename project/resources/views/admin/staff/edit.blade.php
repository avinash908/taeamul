@extends('layouts.admin.app')
@section('content')
<div class="py-4"></div>
<div class="container bg-white rounded-pill p-5">
	<h1>{{__('Edit Staff')}}</h1>
	<div class="form-content  p-3">
		<form method="post" action="{{route('staffs.update',$user->id)}}" enctype="multipart/form-data">
			@if ($errors->any())
		        <ul class="alert alert-danger">
		            @foreach($errors->all() as $error)
		                <li>{{ __($error) }}</li>
		            @endforeach
		        </ul>
		    @endif
			@csrf
			<input type="hidden" name="_method" value="put">
			<div class="form-group">
				<div class="row">
					<div class="col-lg-3 offset-lg-4">
						<input type="file" class="drop-image" data-default-file="{{asset($user->avatar)}}" data-allowed-file-extensions="jpeg png jpg gif" name="image">
					</div>
				</div>
			</div>
			<div class="form-group">
				<label>{{__('Name')}}</label>
				<input type="text" name="name" class="form-control rounded-0" value="{{__($user->name)}}"  required>
			</div>
			<div class="form-group">
				<label>{{__('Email')}}</label>
				<input type="email" name="email" class="form-control rounded-0" value="{{$user->email}}"   required>
			</div>
			<div class="form-group">
				<label>{{__('Phone')}}</label>
				<input type="text" name="phone" class="form-control rounded-0" value="{{$user->phone}}"   required>
			</div>
			<div class="form-group">
				<label>{{__('Role')}}</label>
				<select name="role" class="form-control" required>
					@foreach($roles as $role)
					<option value="{{$role->id}}" 
						@foreach($user->getRoleNames() as $rname)
						{{($rname == $role->name ) ? 'selected="selected"' : '' }}
						@endforeach
					 >{{__($role->name)}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label>{{__('Password')}}</label>
				<input type="password" name="password" class="form-control rounded-0" >
			</div>
			<button type="submit" class="btn btn-primary rounded-0 float-right">{{__('Save')}}</button>
		</form>
	</div>
</div>
@endsection
@section('javascript')
<script type="text/javascript">
  $('.drop-image').dropify();
</script>
@endsection