@extends('layouts.admin.app')
@section('content')
<div class="py-4"></div>
<div class="container bg-white rounded-pill p-5">
	<h1>{{__('Edit Category')}}</h1>
	<div class="form-content  p-3">
		<form method="post" action="{{route('categories.update',$category->id)}}">
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
				<label >{{__('Name')}}</label>
				<input type="text" class="form-control rounded-0" value="{{__($category->name)}}" placeholder="eg: Fashion And Beauty" name="name" required>
			</div>
			<div class="form-group">
				<label >{{__('Slug')}}</label>
				<input type="text" class="form-control rounded-0" value="{{__($category->slug)}}" placeholder="eg:fasion-and-beauty" name="slug" required>
			</div>
			<div  class="form-group">
				<input type="checkbox" name="is_featured" <?=($category->is_featured == 1 ) ? 'checked' : '' ?> value="1">
				<label >{{__('Is Featured?')}}</label>
				<p style="font-size: 12px">{{__('Featured category will be shown on home page')}}</p>
			</div>
			<div class="form-group">
			<label>
				<input id="seo" type="checkbox" <?= ($category->seo) ? 'checked="checked"' : '' ?> name="seo_input">
				{{__('Add Seo')}}
			</label>
			</div>
			<div id="seo-show" <?= ($category->seo) ? '' : 'style="display: none;"' ?> >
				<div class="form-group">
					<label>{{__('Seo Title')}}
						<span style="display: block;font-size: 10px; font-weight: 400">
							{{__('(category Page title)')}}
						</span>
					</label>
					<input type="text" id="seo_title"
					 <?php 
					 if($category->seo){
					 ?>
					 	value="{{__($category->seo->title)}}" 
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
					 if($category->seo){
					 ?>
					 value="
					<?php foreach ($category->seo->meta_tags as $pm_tag): ?>
						{{__('$pm_tag ')}}
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
					<textarea rows="10" class="form-control" class="seo-inputs" name="meta_description">{{($category->seo) ? $category->seo->meta_description : ''}}</textarea>
				</div>
			</div>
			<button type="submit" class="btn btn-primary rounded-0 float-right">{{__('Update')}}</button>
		</form>
	</div>
</div>
@endsection