@extends('layouts.admin.app')
@section('content')
<div class="py-4"></div>
<div class="container bg-white rounded-pill p-5">
	<h1>{{__('Add New Sub Category')}}</h1>
	<div class="form-content  p-3">
		<form method="post" action="{{route('subcategories.store')}}">
			@if ($errors->any())
		        <ul class="alert alert-danger">
		            @foreach($errors->all() as $error)
		                <li>{{ __($error) }}</li>
		            @endforeach
		        </ul>
		    @endif
			@csrf
			<div class="form-group">
				<label >{{__('Category')}}</label>
				<select name="category" class="form-control" required>
					<option value="">{{__('Select Category')}}</option>
					@foreach($categories as $category)
						<option value="{{$category->id}}">{{__($category->name)}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label >{{__('Name')}}</label>
				<input type="text" class="form-control rounded-0" value="{{old('name')}}"  placeholder="eg: Clothes" name="name" required>
			</div>
			<div class="form-group">
				<label >{{__('Slug')}}</label>
				<input type="text" class="form-control rounded-0" value="{{old('slug')}}"  placeholder="eg: clothes" name="slug" required>
			</div>
						<div class="form-group">
				<label>
				<input id="seo" type="checkbox" <?=old('seo_input') ? 'checked' : '' ?> name="seo_input">
					{{__('Add Seo')}}
				</label>
			</div>
			<div id="seo-show" style="display:  <?=old('seo_input') ? 'block' : 'none' ?> ;">
				<div class="form-group">
					<label>{{__('Seo Title')}}
						<span style="display: block;font-size: 10px; font-weight: 400">
							{{__('(Page title)')}}
						</span>
					</label>
					<input type="text" value="{{ old('seo_title') }}" id="seo_title" class="form-control seo-inputs" name="seo_title" />
				</div>
				<div class="form-group">
					<label>{{__('Meta Keywords')}}
						<span style="display: block;font-size: 10px; font-weight: 400">
							{{__('(Add comma after every keyword*)')}}
						</span>
					</label>
						                           
		                <input type="text" id="meta_tags" value="
		                  	@if(old('meta_tags'))
		                   		 @for( $i =0; $i < count(old('meta_tags')); $i++) 
			                  	 {{ old('meta_tags.'.$i)}}
			                  	 @endfor
		                    @endif
		                  	 "  name="meta_tags[]" class="form-control seo-inputs" />                                       
		                    
				</div>
				<div class="form-group">
					<label>{{__('Meta Description')}}
						<span style="display: block;font-size: 10px; font-weight: 400">
							{{__('(Avoid long description*)')}}
						</span>
					</label>
					<textarea rows="10" class="form-control" class="seo-inputs" name="meta_description">{{ old('meta_description') }}</textarea>
				</div>
			</div>
			<button type="submit" class="btn btn-primary rounded-0 float-right">{{__('Create')}}</button>
		</form>
	</div>
</div>
@endsection