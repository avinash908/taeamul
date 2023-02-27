@extends('layouts.admin.app')
@section('content')
<div class="row">
	<div class="col-md-8 offset-2">
	<div class="py-4"></div>
	<div class="container bg-white rounded-pill p-5">
		<h3>{{__("Edit Attribute")}}</h3>
			
			<div class="form-content  p-2">
				<form method="post" action="{{route('admin.attributes.update',$attribute->id)}}">
					@if ($errors->any())
				        <ul class="alert alert-danger">
				            @foreach($errors->all() as $error)
				                <li>{{ __($error) }}</li>
				            @endforeach
				        </ul>
				    @endif
					@csrf
					<div class="form-group">
						<label>{{__("Name*")}}</label>
						<input type="text" name="name" value="{{$attribute->name}}"  placeholder="eg: Brand" class="form-control" required>
					</div>
					<div id="addmoreoptions">
						@foreach($attribute->attribute_options as $option)
						<div class="form-group option-row">
							<label>{{__('Option*')}}</label>
							<div class="input-group">
								<input type="text" name="options[]" value="{{__($option->name)}}" class="form-control" required>
								<span class="input-group-prepend">
									<button type="button" class="deleteoption btn btn-danger btn-sm">
										<i class="mdi mdi-trash-can"></i>
									</button>
								</span>
							</div>
						</div>
						@endforeach
					</div>
					<div class="p-1 text-center">
						<button type="button" id="addoption" class="btn btn-primary btn-sm"><i class="mdi mdi-plus"></i> {{__("Add Option")}}</button>
					</div>
					<div class="p-5">
						<button type="submit" class="btn btn-primary mt-2 btn-block rounded-0 float-right">{{__("UPDATE")}}</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@section('javascript')
<script type="text/javascript">
	$(document).on('click','#addoption',function(){

		var data = '<div class="form-group option-row"><label>{{__("Option*")}}</label><div class="input-group"><input type="text" name="options[]" class="form-control" required><span class="input-group-prepend"><button type="button" class="deleteoption btn btn-danger btn-sm"><i class="mdi mdi-trash-can"></i></button></span></div></div>';

		$("#addmoreoptions").append(data);
	});
	$(document).on('click','.deleteoption',function () {
		$(this).parent().parent().parent('.option-row').remove();
	})
</script>
@endsection