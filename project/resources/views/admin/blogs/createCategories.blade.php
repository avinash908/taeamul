@extends('layouts.admin.app')

@section('content')

<div class="content">
		<div class="container bg-white rounded-pill p-5">
	<h1>{{__('Categories')}}</h1>
	<div class="row">
		<div class="col-md-6">
			<div class="form-content  p-3">
				<form method="post" action="{{route('admin.category.add')}}">
					@csrf
					<div class="form-group">
						<label class="lead">{{__('Add Category')}}</label>
						<div class="input-group">
							<input type="text" class="form-control rounded-0" placeholder="Category" name="addCat" required="">
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
				<form method="post" action="{{route('admin.category.del')}}">
					@csrf
					<input type="hidden" name="_method" value="DELETE">
					<div class="form-group">
						<label class="lead">{{__('Delete Category')}}</label>
						<div class="input-group">
							<select class="form-control" name="dltCat" required="">
								<option selected="selected">{{__('Select Category')}}</option>
								@foreach($cat as $row)
									<option value="{{$row->id}}">{{__($row->title)}}</option>
								@endforeach
							</select>
							<button type="submit" class="btn btn-danger rounded-0 float-right">{{__('DELETE')}}</button>
							
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label>
				<input id="seo" type="checkbox" name="seo_input">
					{{__('Add Seo')}}
				</label>
			</div>
			<div id="seo-show">
				<div class="form-group">
					<label>{{__('Tags')}}</label>
					<input type="text" id="meta_tags" name="meta_tags" />
				</div>
				<div class="form-group">
					<label>{{__('Description')}}</label>
					<textarea rows="10" class="form-control" name="meta_description"></textarea>
				</div>
			</div>
		</div>
	</div>
</div>
	</div>

@endsection
@section('javescript')
<script type="text/javascript">
	$(document).ready(function () {
		$('#seo-show').hide();
	    $('#seo').on('click', function () {
	        if ($(this).prop('checked')) {
           	 	$('#seo-show').fadeIn();
	        } else {
	            $('#seo-show').hide();
	        }
	    });
    });
</script>
@endsection