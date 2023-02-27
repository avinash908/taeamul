@extends('layouts.admin.app')
@section('content')
<div class="py-4"></div>
<div class="container bg-white rounded-pill p-5">
	<h1>{{__('Edit Child Category')}}</h1>
	<div class="form-content  p-3">
		<form method="post" action="{{route('childcategories.update',$childcategory->id)}}">
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
				<label >{{__('Category*')}}</label>
				<select name="scategory" class="form-control category" id="category" required>
					<option value="">{{__('Select Category')}}</option>
					@foreach($categories as $category)
						<option <?=($category->id == $childcategory->subcategory->category->id) ? 'selected="selected"' : '' ?> data-url='{{ route("admin.subcategory.options",$category->id) }}' value="{{$category->id}}">{{__($category->name)}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label >{{__('SubCategory')}}*</label>
				<select name="subcategory" class="form-control" id="subcategory" required>
					<option value="">{{__('Select SubCategory')}}</option>
					@foreach($childcategory->subcategory->category->subs as $subcategory)
					<option <?=($subcategory->id == $childcategory->subcategory->id) ? 'selected="selected"' : '' ?> value="{{$subcategory->id}}">{{__($subcategory->name)}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label >{{__('Name')}}</label>
				<input type="text" class="form-control rounded-0" value="{{__($childcategory->name)}}" placeholder="eg: Shirts" name="name" required>
			</div>
			<div class="form-group">
				<label >{{__('Slug')}}</label>
				<input type="text" class="form-control rounded-0" value="{{$childcategory->slug}}" placeholder="eg: shirts" name="slug" required>
			</div>
			<div class="form-group">
			<label>
				<input id="seo" type="checkbox" <?= ($childcategory->seo) ? 'checked="checked"' : '' ?> name="seo_input">
				{{__('Add Seo')}}
			</label>
			</div>
			<div id="seo-show" <?= ($childcategory->seo) ? '' : 'style="display: none;"' ?> >
				<div class="form-group">
					<label>{{__('Seo Title')}}
						<span style="display: block;font-size: 10px; font-weight: 400">
							{{__('(category Page title)')}}
						</span>
					</label>
					<input type="text" id="seo_title"
					 <?php 
					 if($childcategory->seo){
					 ?>
					 	value="{{__($childcategory->seo->title)}}" 
					 <?php 
						}
					 ?>

					 class="form-control seo-inputs" name="seo_title" />
				</div>
				<div class="form-group">
					<label>{{__('Meta Keywords')}}
						<span style="display: block;font-size: 10px; font-weight: 400">
							{{__('(Add comma after every keyword*)')}}
						</span>
					</label>
					<input type="text" id="meta_tags"
					<?php 
					 if($childcategory->seo){
					 ?>
					 value="
					<?php foreach ($childcategory->seo->meta_tags as $pm_tag): ?>
						{{__($pm_tag)}}
					<?php endforeach ?>
					" 
					<?php 
					}
					?>
					class="seo-inputs" name="meta_tags[]" class="form-control" />
				</div>
				<div class="form-group">
					<label>{{__('Meta Description')}}
						<span style="display: block;font-size: 10px; font-weight: 400">
							{{__('(Avoid long description*)')}}
						</span>
					</label>
					<textarea rows="10" class="form-control" class="seo-inputs" name="meta_description">{{($childcategory->seo) ? $childcategory->seo->meta_description : ''}}</textarea>
				</div>
			</div>
			<button type="submit" class="btn btn-primary rounded-0 float-right">{{__('Update')}}</button>
		</form>
	</div>
</div>
@endsection
@section('javascript')
<script type="text/javascript">
	$(document).on('change','select.category',function () {

		// var cat = $(this).children("option:selected").val();s
		var url =  $(this).children("option:selected").attr('data-url');

		$.ajax({
			url:url,
			method:'GET',
			success:function(data){
				$("#subcategory").empty();
				$("#subcategory").html(data.html);
			}
		});
	})
</script>
@endsection