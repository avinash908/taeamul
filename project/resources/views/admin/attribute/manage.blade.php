@extends('layouts.admin.app')
@section('content')
<div class="row">
	<div class="col-md-8 offset-2">
		<div class="py-4"></div>
		<div class="container bg-white rounded-pill p-5">
			<h3 class="pb-3">{{__('Manage')}} {{ __($cat->name) }} {{__('Attributes')}}</h3>
			@foreach($cat->attributes as $attribute)
			<div class="row p-2">
				<div class="col-md-3">
					<label>{{__(ucwords($attribute->name))}}*</label>
				</div>
				<div class="col-md-6">
					@foreach ($attribute->attribute_options as $key => $option)
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" id="customRadioInline{{$option->id}}" name="{{ $attribute->id }}" class="custom-control-input">
                      <label class="custom-control-label" for="customRadioInline{{$option->id}}">{{ __($option->name) }}</label>
                    </div>
                  @endforeach
				</div>
				<div class="col-md-3">
					<form action="{{route('admin.attributes.delete',$attribute->id)}}" class="attribute_delete" method="POST">
						@csrf
						<input type="hidden" name="_method" value="DELETE">
						<div class="btn-group">
							<a href="{{route('admin.attributes.edit',$attribute->id)}}" class="btn btn-dark btn-sm"><i class="mdi mdi-pen"></i></a>
							<a href="javascript:void(0)" on class="btn btn-danger btn-sm attribute_delete_btn"><i class="mdi mdi-trash-can"></i></a>
						</div>
					</form>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>
@endsection
@section('javascript')
<script type="text/javascript">
	$(document).on('click','.attribute_delete_btn',function (e) {
		e.preventDefault();
		var attr_dlt_from = $(this).parent().parent('form');
		swal({
	        title: 'Are you sure?',
	        text: "Maybe You won't be able to revert this!",
	        icon: 'warning',
	        showCancelButton: true,
	        confirmButtonColor: '#3f51b5',
	        cancelButtonColor: '#ff4081',
	        confirmButtonText: 'Great ',
	        buttons: {
	          cancel: {
	            text: "Cancel",
	            value: null,
	            visible: true,
	            className: "btn btn-danger",
	            closeModal: true,
	          },
	          confirm: {
	            text: "YES",
	            value: true,
	            visible: true,
	            className: "btn btn-primary",
	            closeModal: true
	          }
	        }
	      }).then(function(isConfirm) {
        if (isConfirm) {
        	attr_dlt_from.submit();
        }
      })
	});

</script>
@endsection