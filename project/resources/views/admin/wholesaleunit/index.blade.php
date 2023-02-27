@extends('layouts.admin.app')
@section('content')
<div class="py-4"></div>
<div class="container bg-white rounded-pill p-5">
	<h1>{{__('Wholesale Units')}}</h1>
	<div class="row">
		<div class="col-md-6">
			<div class="form-content  p-3">
				<form method="post" action="{{route('wholesaleunits.store')}}">
					@csrf
					<div class="form-group">
						<label class="lead">{{__('Add Unit')}}</label>
						<div class="input-group">
							<input type="text" class="form-control rounded-0" placeholder="eg: Kilogram" name="unit" required>
							<span class="input-group-btn">
								
							<button type="submit" class="btn btn-primary rounded-0 float-right">{{__('Add')}}</button>
							</span>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-content  p-3">
				<form method="post" action="{{route('wholesaleunits.destroy',1)}}">
					@csrf
					<input type="hidden" name="_method" value="DELETE">
					<div class="form-group">
						<label class="lead">{{__('Units')}}</label>
						<div class="input-group">
							<select class="form-control" name="unit" required>
								<option disabled></option>
								@foreach($units as $u)
									<option value="{{$u->id}}">{{__($u->unit)}}</option>
								@endforeach
							</select>
								
							<button type="submit" class="btn btn-danger rounded-0 float-right">{{__('DELETE')}}</button>
							</span>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection