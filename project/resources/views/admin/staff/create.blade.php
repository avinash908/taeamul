@extends('layouts.admin.app')
@section('content')
<div class="py-4"></div>
<div class="container bg-white rounded-pill p-5">
	<h1>{{__('Add New Member')}}</h1>
	<div class="form-content  p-3">
		<form method="post" action="{{route('staffs.store')}}" enctype="multipart/form-data">
			@if ($errors->any())
		        <ul class="alert alert-danger">
		            @foreach($errors->all() as $error)
		                <li>{{ __($error) }}</li>
		            @endforeach
		        </ul>
		    @endif
			@csrf
			<div class="form-group">
				<div class="row">
					<div class="col-lg-3 offset-lg-4">
						<input type="file" class="drop-image" data-allowed-file-extensions="jpeg png jpg gif" name="image">
					</div>
				</div>
			</div>
			<div class="form-group">
				<label>{{__('Name')}}</label>
				<input type="text" name="name" class="form-control rounded-0" value="{{old('name')}}"  required>
			</div>
			<div class="form-group">
				<label>{{__('Email')}}</label>
				<input type="email" name="email" class="form-control rounded-0" value="{{old('email')}}"  required>
			</div>
			<div class="form-group">
				<label>{{__('Phone')}}</label>
				<input type="text" name="phone" class="form-control rounded-0" value="{{old('phone')}}"  required>
			</div>
			<div class="form-group">
				<label>{{__('Role')}}</label>
				<select name="role" class="form-control" required>
					<option value="">{{__('Select Role')}}</option>
					@foreach($roles as $role)
					<option value="{{$role->id}}">{{__($role->name)}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label>{{__('Password')}}</label>
				<input type="password" name="password" class="form-control rounded-0" value="{{old('password')}}"  required>
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