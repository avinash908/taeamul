@extends('layouts.admin.app')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/select2.css')}}">
@endsection
@section('content')
<div class="py-4"></div>
<div class="container bg-white rounded-pill p-5">
	<h1>{{__('Edit Role')}}</h1>
	<div class="form-content  p-3">
		<form method="post" action="{{route('roles.update',$role->id)}}">
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
				<label>{{__('Role Name')}}</label>
				<input type="text" name="role_name" class="form-control rounded-0" value="{{__($role->name)}}"  required>
			</div>
			<div class="form-group">
				<label>{{__('Role Permissions')}}</label>
				<select name="permissions[]" class="form-control" id="permissions" multiple="multiple" required>
					@foreach($permissions as $perm)
						<option value="{{$perm->id}}" {{ ($role->permissions()->where('name',$perm->name)->first()) ? 'selected="selected"' : '' }} >{{__($perm->name)}}</option>
					@endforeach
				</select>
			</div>
			<button type="submit" class="btn btn-primary rounded-0 float-right">{{__('Save')}}</button>
		</form>
	</div>
</div>
@endsection
@section('javascript')
<script type="text/javascript" src="{{asset('assets/admin/js/select2.js')}}"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#permissions').select2();
});
</script>
@endsection