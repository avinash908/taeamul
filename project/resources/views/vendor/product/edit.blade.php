@extends("layouts.vendor.app")
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/image-uploader.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/jquery.tagsinput-revisited.css')}}">
<style type="text/css">
	div.tagsinput span.tag {
    background: #282f3a !important;
    color: #ffffff;
    line-height: 1.4;
    padding: 8px 24px !important;
}
.delete-options {
    position: absolute;
    margin: auto;
    right: 46px;
    background-color: red;
    color: white;
    padding: 5px;
    font-size: 0.8rem;
    cursor: pointer;
}
.p-galler-img-box{
   display: inline-block;
    width: calc(16.6666667% - 1rem);
    padding-bottom: calc(16.6666667% - 1rem);
    height: 0;
    position: relative;
    margin: .5rem;
    background: #f3f3f3;
    cursor: default;
}
.p-galler-img-box img{
	width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute;
}
.p-img-delete-icon{
	position: absolute;
    margin: auto;
    top: .2rem;
    right: .0rem;
    border-radius: 50%;
    background-color: #000000a6;
    color: white;
    padding: 1rem;
    font-size: 0.8rem;
    cursor: pointer;
}

</style>
@endsection
@section('content')

<div class="container">
	<form action="{{route('v-product.update',$product->id)}}" class="row" method="POST" enctype="multipart/form-data" id="update_product">
		@csrf
		<div class="bg-white p-5 col-xl-8 col-lg-8 col-md-8 col-sm-12 shadow-lg">
			<div class="pb-4">	
			<h1 >Edit Product</h1>
				<p style="color: red; font-size: 12px;"><b>Note:</b> All prices are in SR Currency format, Please  fill prices only in numbers*</p>
			</div>
				<div class="alert alert-danger" id="msg" style="display: none;"></div>
			<div class="form-group">
				<label>Product Name*</label>
				<input type="text"  class="form-control" value="{{$product->name}}" name="name" required>
			</div>
			<div class="form-group">
				<label>Product Sku*</label>
				<input type="text" value="{{$product->sku}}" class="form-control" id="sku" name="sku" required>
			</div>
			<div class="form-group">
				<label>
				<input id="condition" type="checkbox" <?= ($product->condition) ? 'checked="checked"' : '' ?> name="condition_input">
					Add Product Condition
				</label>
			</div>
			<div class="form-group" id="condition-show" <?= ($product->condition) ? '' : 'style="display: none"';  ?> > 
				<label>Product Condition</label>
				<select name="condition" class="form-control">
					<option disabled> Select</option>
					<option value="new" <?= ($product->condition == 'new') ? 'selected="selected"' : '' ?> >New</option>
					<option value="used" <?= ($product->condition == 'used') ? 'selected="selected"' : '' ?> >Used</option>
				</select>
			</div>
			<div class="form-group">
				<label>Category*</label>
				<select name="category" id="category" class="form-control category" required>
					<option value="">Select Category</option>
					@foreach($categories as $category)
						<option value="{{$category->id}}" <?= ($category->id == $product->category_id ) ? 'selected="selected"' : '' ?> data-url="{{route('admin.categorysubcategory.options',$category->id)}}">{{$category->name}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label>Sub Category*</label>
				<select name="subcategory" id="subcategory" class="form-control subcategory">
					<option value="">{{ __('Select Sub Category') }}</option>
					@if($product->subcategory_id == null)
					@foreach($product->category->subs as $sub)
						<option value="{{$sub->id}}" data-url="{{route('admin.subchildcategory.options',$sub->id)}}">{{$sub->name}}</option>
					@endforeach
					@else
					@foreach($product->category->subs as $sub)
						<option value="{{$sub->id}}" <?= ($sub->id == $product->subcategory_id ) ? 'selected="selected"' : '' ?> data-url="{{route('admin.subchildcategory.options',$sub->id)}}">{{$sub->name}}</option>
					@endforeach
					@endif
				</select>
			</div>
			<div class="form-group">
				<label>Child Category*</label>
				<select name="childcategory" id="childcategory" class="form-control childcategory" <?=$product->subcategory_id == null ? "disabled":""?> >
					<option value="">Select Child Category</option>
					@if($product->subcategory_id != null)
						@if($product->childcategory_id == null)
						@foreach($product->subcategory->childs as $child)
							<option value="{{$child->id}}" data-url="{{route('admin.childcategory.attributes',$child->id)}}" >{{$child->name}}</option>
						@endforeach
						@else
						@foreach($product->subcategory->childs as $child)
							<option value="{{$child->id}}" <?= ($child->id == $product->childcategory_id ) ? 'selected="selected"' : '' ?> data-url="{{route('admin.childcategory.attributes',$child->id)}}" >{{$child->name}}</option>
						@endforeach
						@endif
					@endif
				</select>
			</div>
			<div class="attrs-container mt-4 mb-4 form-control">

				@php
					$selectedAttrs = json_decode($product->attributes, true);
					// dd($selectedAttrs)
				@endphp


				{{-- Attributes of category starts --}}
				<div class="form-group">
					<div id="category_attributes">
						@php
							$catAttributes = !empty($product->category->attributes) ? $product->category->attributes : '';
						@endphp
						@if (!empty($catAttributes))
							@foreach ($catAttributes as $catAttribute)
								<div class="row pt-4">
									<div class="col-md-3">
										<label>{{ucwords($catAttribute->name)}}*</label>
									</div>
									 <div class="col-md-9">
										 @php
										 	$i = 0;
										 @endphp
										 @foreach ($catAttribute->attribute_options as $optionKey => $option)
											 @php
												$inName = $catAttribute->input_name;
												$checked = 0;
											 @endphp

										 	<div class="custom-control custom-checkbox custom-control-inline">
												 <input type="checkbox" id="{{ $catAttribute->input_name }}{{$option->id}}" name="{{ $catAttribute->input_name }}[]" value="{{$option->name}}" class="custom-control-input attr-checkbox"
												 @if (is_array($selectedAttrs) && array_key_exists($catAttribute->input_name,$selectedAttrs))
													 @if (is_array($selectedAttrs["$inName"]["values"]) && in_array($option->name, $selectedAttrs["$inName"]["values"]))
														 checked
													 @php
													 	$checked = 1;
													 @endphp
													 @endif
												 @endif
												 >
												 <label class="custom-control-label" for="{{ $catAttribute->input_name }}{{$option->id}}">{{ $option->name }}</label>
											</div>

											 @php
												 if ($checked == 1) {
												 	$i++;
												 }
											 @endphp
										@endforeach
									 </div>

								</div>
							@endforeach
						@endif
					</div>
				</div>
				{{-- Attributes of category ends --}}


				{{-- Attributes of subcategory starts --}}
				<div class="form-group">
					<div id="subcategory_attributes">
						@php
							$subAttributes = !empty($product->subcategory->attributes) ? $product->subcategory->attributes : '';
						@endphp
						@if (!empty($subAttributes))
							@foreach ($subAttributes as $subAttribute)
								<div class="row pt-4">
									<div class="col-md-3">
										<label>{{ucwords($subAttribute->name)}}*</label>
									</div>
									 <div class="col-md-9">
											 @php
											 	$i = 0;
											 @endphp
											 @foreach ($subAttribute->attribute_options as $option)
												 @php
													$inName = $subAttribute->input_name;
													$checked = 0;
												 @endphp

											       <div class="custom-control custom-checkbox custom-control-inline">
											          <input type="checkbox" id="{{ $subAttribute->input_name }}{{$option->id}}" name="{{ $subAttribute->input_name }}[]" value="{{$option->name}}" class="custom-control-input attr-checkbox"
											          @if (is_array($selectedAttrs) && array_key_exists($subAttribute->input_name,$selectedAttrs))
											          @php
											          $inName = $subAttribute->input_name;
											          @endphp
											          @if (is_array($selectedAttrs["$inName"]["values"]) && in_array($option->name, $selectedAttrs["$inName"]["values"]))
											          checked
													  @php
													 	$checked = 1;
													  @endphp
											          @endif
											          @endif
											          >
											          <label class="custom-control-label" for="{{ $subAttribute->input_name }}{{$option->id}}">{{ $option->name }}</label>
											       </div>
												 @php
													 if ($checked == 1) {
													 	$i++;
													 }
												 @endphp
											@endforeach

									 </div>
								</div>
							@endforeach
						@endif
					</div>
				</div>
				{{-- Attributes of subcategory ends --}}


				{{-- Attributes of child category starts --}}
				<div class="form-group">
					<div id="childcategory_attributes">
						@php
							$childAttributes = !empty($product->childcategory->attributes) ? $product->childcategory->attributes : '';
						@endphp
						@if (!empty($childAttributes))
							@foreach ($childAttributes as $childAttribute)
								<div class="row pt-4">
									<div class="col-md-3">
										<label>{{ucwords($childAttribute->name)}}*</label>
									</div>
									 <div class="col-md-9">
										 @php
										 	$i = 0;
										 @endphp
										 @foreach ($childAttribute->attribute_options as $optionKey => $option)
											 @php
												$inName = $childAttribute->input_name;
												$checked = 0;
											 @endphp
											 <div class="custom-control custom-checkbox custom-control-inline">
													 <input type="checkbox" id="{{ $childAttribute->input_name }}{{$option->id}}" name="{{ $childAttribute->input_name }}[]" value="{{$option->name}}" class="custom-control-input attr-checkbox"
													 @if (is_array($selectedAttrs) && array_key_exists($childAttribute->input_name,$selectedAttrs))
														 @php
															$inName = $childAttribute->input_name;
														 @endphp
														 @if (is_array($selectedAttrs["$inName"]["values"]) && in_array($option->name, $selectedAttrs["$inName"]["values"]))
															 checked
														 @php
														 	$checked = 1;
														 @endphp
														 @endif
													 @endif
													 >
													 <label class="custom-control-label" for="{{ $childAttribute->input_name }}{{$option->id}}">{{ $option->name }}</label>
												</div>
											 @php
												 if ($checked == 1) {
												 	$i++;
												 }
											 @endphp
											@endforeach
									 </div>

								</div>
							@endforeach
						@endif
					</div>
				</div>
				{{-- Attributes of child category ends --}}
			</div>
			<div class="form-group">
				<label>
				<input id="size" type="checkbox" name="size_input" <?= (count($product->sizes) > 0 ) ? 'checked="checked"' : '' ?> >
					Add Product Sizes
				</label>
			</div>
			<div class="form-group" id="size-show" <?= (count($product->sizes) > 0 ) ? '' : 'style="display: none"';  ?> >

				<div class="addmoresizes">
					
				@foreach($product->sizes as $p_size)
				<div class="row py-3 offset-1 extra-sizes">
					<div class="form-group col-4 pb-3">
						<label>Size*
							<span style="display: block;font-size: 10px; font-weight: 400">
								(eg. S,M,L,XL or 12,13,14)
							</span>
						</label>
						<input id="size" placeholder="eg: M" type="text" name="sizes[]" value="{{$p_size->title}}" class="form-control size-inputs">
					</div>
					<div class="form-group col-4 pb-3">
						<label>Size Quantity*
							<span style="display: block;font-size: 10px; font-weight: 400">
								
								(Available quantity of this size?)
							</span>
						</label>
						<input id="sizes_qty" placeholder="eg: 12" type="number" name="sizes_qty[]" value="{{$p_size->quantity}}" min="0" class="form-control size-inputs">
					</div>
					<div class="form-group col-4 pb-3">
						<label>Size Price*
							<span style="display: block;font-size: 10px; font-weight: 400">
								(Price in numbers)
							</span>
						</label>
						<input id="sizes_price" placeholder="eg: 1000" type="number" value="{{$p_size->price}}" name="sizes_price[]" min="0" class="form-control size-inputs">
					</div>
					<span class="delete-options">&#10006;</span>
				</div>
				@endforeach

				</div>

				<div class=" pt-2 text-center">
					<button type="button" id="addsizes" class="btn btn-primary btn-sm"><i class="mdi mdi-plus"></i> Add Size</button>
					
				</div>
			</div>
			<div class="form-group">
				<label>
				<input id="color" type="checkbox" <?= (count($product->colors) > 0 ) ? 'checked="checked"' : '' ?> name="color_input"  >
					Add Product Colors
				</label>
			</div>
			<div class="form-group" id="color-show" <?= (count($product->colors) > 0 ) ? '' : 'style="display: none"';  ?> >

				<div class="addmorecolors">
				@foreach($product->colors as $p_color)
				<div class="row py-3 offset-1 extra-colors">
					<div class="form-group col-4">
					<label>Color Name*
							<span style="display: block;font-size: 10px; font-weight: 400">
								(Type color name)
							</span>
					</label>
					<input id="color_name" placeholder="eg: Black" value="{{$p_color->name}}" type="text" name="colors_name[]" class="form-control color-inputs">
					</div>
					<div class="form-group col-4">
					<label>Color*
							<span style="display: block;font-size: 10px; font-weight: 400">
								(Select color or type color code)
							</span>
					</label>
					<div class="input-group color-code-section mb-3">
						<div class="input-group-prepend">
				            <input type="color" class="form-control color-code-picker" value="{{$p_color->code}}" style="padding: 0px;height: auto;width: 30px;">
			        	</div>
					  <input id="color_code" placeholder="eg: #000000" type="text" value="{{$p_color->code}}" name="colors[]" class="form-control color-code color-inputs">
					</div>
					</div>
					<div class="form-group col-4">

					<label>Color Quantity*
						<span style="display: block;font-size: 10px; font-weight: 400">
								(Available quantity of this color?)
							</span>
					</label>
					<input id="color_qty" placeholder="eg: 12" min="0" type="number" value="{{$p_color->quantity}}" name="colors_qty[]" class="form-control color-inputs">
					</div>
					<span class="delete-options">&#10006;</span>
				</div>
				@endforeach
				</div>
				<div class=" pt-2 text-center">
					<button type="button" id="addcolor" class="btn btn-primary btn-sm"><i class="mdi mdi-plus"></i> Add Color</button>
				
				</div>
			</div>
			<div class="form-group">
				<label>
				<input id="sale" type="checkbox" <?= (count($product->wholesale) > 0 ) ? 'checked="checked"' : '' ?> name="wholesale_input">
					Add Whole Sale
				</label>
			</div>
			<div class="form-group" id="sale-show" <?= (count($product->wholesale) > 0 ) ? '' : 'style="display: none"';  ?> >
				<div class="addmorewholesales">
					@foreach($product->wholesale as $p_wholesale)
						<div class="row py-3 offset-1 extra-wholesales">
							<div class="form-group col-4">
							<label>Quantity*
									<span style="display: block;font-size: 10px; font-weight: 400">
										(Wholesale quantity in number)
									</span>
							</labels>
								<input  placeholder="eg: 12" type="number" value="{{$p_wholesale->qty}}" name="whole_sale_qty[]" class="form-control whole-inputs pb-3" min="0">
							</div>
							<div class="form-group col-4">
								<label>Unit*
										<span style="display: block;font-size: 10px; font-weight: 400">
											(Select wholesale unit)
										</span>
								</label>
								<select class="form-control" name="whole_sale_unit[]">
									@foreach(App\WholeSaleUnit::all() as $u)
									<option value="{{$u->unit}}" <?= ($p_wholesale->unit == $u->unit) ? 'selected="selected"' : '' ?> >{{$u->unit}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group col-4">
							<label>Price*
									<span style="display: block;font-size: 10px; font-weight: 400">
										(Price in number only*)
									</span>
							</label>
								<input  placeholder="eg: 10000" type="number" min="0" value="{{$p_wholesale->price}}" name="whole_sale_price[]" class="form-control whole-inputs pb-3">
							</div>
							<span class="delete-options">&#10006;</span>
						</div>
					@endforeach
				</div>
				<div class=" pt-2 text-center">
					<button type="button" id="addwsale" class="btn btn-primary btn-sm"><i class="mdi mdi-plus"></i> Add Wholesale</button>
				
				</div>
			</div>
			<div class="form-group">
				<label>Product Short Description*</label>
				<textarea class="form-control" rows="10" name="short_description" placeholder="eg: lorem ipusm is dummy text ....." required>{{$product->short_description}}</textarea>
			</div>
			<div class="form-group">
				<label>Product Description*</label>
				<input id="x" type="hidden"  style="z-index: -99" class="form-control" name="description"  required>
					<trix-editor input="x">{!! $product->description !!}</trix-editor>
			</div>
			

		</div>
		<div class="bg-white  shadow-lg col-xl-3 col-lg-3 col-md-12 col-sm-12  offset-lg-1">
				<div class="form-group">
				<label class="pt-3">Product Thumbnail*</label>
				<!-- <img id="blah" class="img-responsive" src="" width="100%" /> -->
				<div class="text-center">
					
						<input type="file" class="drop-image" accept="image/*" name="product_thumbnail" placeholder="Choose Image" data-allowed-file-extensions="jpeg png jpg gif" data-default-file="{{url('/').'/'.$product->thumbnail}}" >
				</div>
			</div>
				<div class="form-group">
					<label class="pt-3">Product Images
					<span style="display: block;font-size: 10px; font-weight: 400">
						(Choose multiple images*)
					</span>
					</label>
					<div >
						<button type="button" class="btn rounded-0 btn-primary" data-toggle="modal" data-target="#images-modal"><i class="mdi mdi-library-plus"></i> Change Images</button>
					</div>
					<div class="modal fade" id="images-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
					  <div class="modal-dialog modal-lg">
					    <div class="modal-content" style="cursor: pointer;">
					    	<div class="modal-header">
					    		<h3 class="modal-heading">Drop Images<small class="text-muted" style="font-size: 12px"> (below section)</small></h3>
					    	</div>
					    	<div class="input-images"></div>
					    	<div id="product_images_gallery">
					    		@include('admin.product.ajax.images')
					    	</div>
							<div class="modal-footer">
						    	<button type="button" data-dismiss="modal" class="btn btn-danger btn-sm">Close</button>
						    	<button type="button" data-dismiss="modal" class="btn btn-dark btn-sm">Done</button>
						    </div>
					    </div>
					    
					  </div>
					</div>
				</div>
				<div class="form-group">
				<label>Product Price*
					<span style="display: block;font-size: 10px; font-weight: 400">
						(Price must be in number)
					</span>
				</label>
				<input type="number" class="form-control" maxlength="11"  value="{{$product->price}}" name="price" placeholder="eg: 1000" required>
			</div>
				<div class="form-group">
					<label>Product Old Price
						<span style="display: block;font-size: 10px; font-weight: 400">
							(Price must be in number)
						</span>
					</label>
					<input type="number" class="form-control"  value="{{$product->old_price}}" name="old_price" placeholder="eg: 1000">
				</div>
				<div class="form-group">
					<label>Product Stock*
						<span style="display: block;font-size: 10px; font-weight: 400">
							(Product stock in number)
						</span>
					</label>
					<input type="number"  class="form-control" value="{{$product->stock}}" name="stock" placeholder="eg: 50" required>
				</div>
				<div class="form-group">
					<label>Product Tags
						<span style="display: block;font-size: 10px; font-weight: 400">
							(Add comma after every keyword)
						</span>
					</label>
					<input type="text" id="tags" name="tags[]" value="
					<?php foreach ($product->tags as $p_tag): ?>
							<?=$p_tag->name.',' ?>
					<?php endforeach ?>
					" class="form-control" placeholder="eg: Bag, Black Bag etc ..." />
				</div>
		</div>
		<div class="bg-white p-5 col-xl-12 col-lg-8 col-md-8 col-sm-12 shadow-lg" style="margin-top: 1%">
			<div class="form-group">
				<label>
				<input id="seo" type="checkbox" <?= ($product->seo) ? 'checked="checked"' : '' ?> name="seo_input">
					Add Seo
				</label>
			</div>
			<div id="seo-show" <?= ($product->seo) ? '' : 'style="display: none;"' ?> >
				<div class="form-group">
					<label>Seo Title
						<span style="display: block;font-size: 10px; font-weight: 400">
							(Product Page title)
						</span>
					</label>
					<input type="text" id="seo_title"
					 <?php 
					 if($product->seo){
					 ?>
					 	value="{{$product->seo->title}}" 
					 <?php 
						}
					 ?>

					 class="form-control seo-inputs" name="seo_title" />
				</div>
				<div class="form-group">
					<label>Meta Keywords
						<span style="display: block;font-size: 10px; font-weight: 400">
							(Add comma after every keyword*)
						</span>
					</label>
					<input type="text" id="meta_tags"
					<?php 
					 if($product->seo){
					 ?>
					 value="
					<?php foreach ($product->seo->meta_tags as $pm_tag): ?>
						<?=$pm_tag ?>
					<?php endforeach ?>
					" 
					<?php 
					}
					?>
					class="seo-inputs" name="meta_tags[]" class="form-control" />
				</div>
				<div class="form-group">
					<label>Meta Description
						<span style="display: block;font-size: 10px; font-weight: 400">
							(Avoid long description*)
						</span>
					</label>
					<textarea rows="10" class="form-control" class="seo-inputs" name="meta_description">
						<?php 
						 if($product->seo){
						 ?>
						{{$product->seo->meta_description}}
						<?php 
							}
						?>
					</textarea>
				</div>
			</div>
			<div class="form-group pt-5">
				<button type="submit" class="btn btn-primary btn-lg float-right" id="submit-btn"> UPDATE</button>
			</div>
		</div>
	</form>
</div>
@endsection
@section('javascript')
<script type="text/javascript" src="{{asset('assets/admin/js/image-uploader.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/admin/js/jquery.tagsinput-revisited.js')}}"></script>
<script type="text/javascript">

	// tagger(document.querySelector('#tags'));
	// tagger(document.querySelector('#meta_tags'));

	$('#tags').tagsInput({

		  // allows new tags
		  interactive: true,

		  // custom placeholder
		  placeholder: 'Bag, Black Bag etc ...',

		  // width/height
		  width: 'auto',
		  height: 'auto',

		  // hides the regular input field
		  hide: true,

		  // custom delimiter
		  delimiter: ',',

		  // removes tags with backspace
		  removeWithBackspace: true

	});
	$('#meta_tags').tagsInput({

		  // allows new tags
		  interactive: true,

		  // custom placeholder
		  placeholder: 'Keyword1, Keyword2, Keyword3 ..... ',

		  // width/height
		  width: 'auto',
		  height: 'auto',

		  // hides the regular input field
		  hide: true,

		  // custom delimiter
		  delimiter: ',',

		  // removes tags with backspace
		  removeWithBackspace: true

	});
	// Product thumbnail
	$('.drop-image').dropify();

	// Product Images
	$('.input-images').imageUploader({Default: ['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml']});

	$(document).on('click','.dlt_p_img',function(){
		var url = $(this).attr('data-url');
		$.ajax({
			url: url,
			method:'GET',
			success:function(data){
				if (data.msg == 'success') {
					$("#product_images_gallery").html(data.html);
	            	success(data.success);
	        	}
			}
		})
	});

	$(document).on('mouseup change','.color-code-picker',function(){
		var color_code_section = $(this).parent('div').parent('.color-code-section');
		color_code_section.children(".color-code").val($(this).val());
	});

	$('#update_product').submit(function(e) {

		e.preventDefault();
		    $.ajax({
		        url: '{{ route("admin.product.update",$product->id) }}',
		        method: 'POST',              
		        data: new FormData(this),
		        contentType:false,
		        cache:false,
		        processData:false,
		        beforeSend: function() {
			        $("#submit-btn").attr('disabled','disabled');
			        $("#t_loading").show(100);
			    },
		        success: function(data)
		        {
		        	if (data.msg == 'success') {
		            	success(data.success);
		        	}else{
		        		$('#msg').html(data.error);
		        		$('#msg').show(400);
		        		$(window).scrollTop(100);
		        	}
		        },
		        complete:function () {
			        $("#t_loading").hide(100);
		            $("#submit-btn").removeAttr('disabled');
		        }
		    });
		});

	    function set_new_Sku() {
    	$.ajax({
    		url:'{{route("admin.generate.Sku")}}',
    		method:'GET',
    		success:function(sku){
    			$('#sku').val(sku);
    		}
    	});
    }

	$(function () {
		 $('#condition').on('click', function () {
	        condition_box();
	    });

		$('#sale').on('click', function () {
	      	 wholesale_box();
	    });

		$('#size').on('click', function () {
	       	size_box();
	    });
		$('#color').on('click', function () {
	      	color_box();
	    });
	   	$('#seo').on('click', function () {
	        seo_box()
	    });
		function condition_box() {
		 	if ($("#condition").prop('checked')) {
           	 	$('#condition-show').fadeIn();
	        } else {
	            $('#condition-show').hide();
	        }
		 }
		 condition_box();

		function wholesale_box() {
		 	if ($("#sale").prop('checked')) {
	        	$('.whole-inputs').attr('required','required');
           	 	$('#sale-show').fadeIn();
	        } else {
	        	$('.whole-inputs').removeAttr('required');
	            $('#sale-show').hide();
	        }
		 }
	    wholesale_box();


	    function size_box() {
	    	if ($("#size").prop('checked')) {
	        	$('.size-inputs').attr('required','required');
           	 	$('#size-show').fadeIn();
	        } else {
	        	$('.size-inputs').removeAttr('required');
	            $('#size-show').hide();
	        }
	    }
	    size_box();

	    function color_box() {
	    	if ($("#color").prop('checked')) {
	        	$('.color-inputs').attr('required','required');
           	 	$('#color-show').fadeIn();
	        } else {
	        	$('.color-inputs').removeAttr('required');
	            $('#color-show').hide();
	        }
	    }
	    color_box();

	    function seo_box() {
	    	if ($("#seo").prop('checked')) {
	        	$('.seo-inputs').attr('required','required');
           	 	$('#seo-show').fadeIn();
	        } else {
	        	$('.seo-inputs').removeAttr('required');
	            $('#seo-show').hide();
	        }
	    }
	   	seo_box();
	});

	$(document).on('change','select.category',function () {
		var url =  $(this).children("option:selected").attr('data-url');
		var v =  $(this).children("option:selected").val();
		if (v != "") {
			$(".attrs-container").addClass('form-control');
			$.ajax({
				url:url,
				method:'GET',
				success:function(data){
					$("#subcategory").removeAttr('disabled');
					$("#subcategory").html(data.subcategories);
					if (data.category_attributes != "") {
						$("#category_attributes").html(data.category_attributes);
					}else{
						$("#category_attributes").html('');
					}
				$("#subcategory_attributes").html('');
				$("#childcategory_attributes").html('');
				}
			});
		}else{
			$(".attrs-container").removeClass('form-control');
			$("#category_attributes").html('');
			$("#subcategory_attributes").html('');
			$("#childcategory_attributes").html('');
			$("#childcategory").attr('disabled','disabled');
			$("#subcategory").attr('disabled','disabled');
		}
	})
	$(document).on('change','select.subcategory',function () {
		var url =  $(this).children("option:selected").attr('data-url');
		var v =  $(this).children("option:selected").val();
		if (v != "") {
		$.ajax({
			url:url,
			method:'GET',
			success:function(data){
				$("#childcategory").removeAttr('disabled');
				$("#childcategory").html(data.childcategories);
				if (data.subcategory_attributes != "") {
					$("#subcategory_attributes").html(data.subcategory_attributes);
				}else{
					$("#subcategory_attributes").html('');
				}

				$("#childcategory_attributes").html('');
			}

		});
		}else{
			$("#subcategory_attributes").html('');
			$("#childcategory_attributes").html('');
			$("#childcategory").attr('disabled','disabled');
		}
	})
	$(document).on('change','select.childcategory',function () {
		var url =  $(this).children("option:selected").attr('data-url');
		var v =  $(this).children("option:selected").val();
		if (v != "") {
		$.ajax({
			url:url,
			method:'GET',
			success:function(data){
				if (data.childcategory_attributes != "") {
					$("#childcategory_attributes").html(data.childcategory_attributes);
				}else{
					$("#childcategory_attributes").html('');
				}
			}
		});
		}else{
			$("#childcategory_attributes").html('');
		}
	})
</script>
<script type="text/javascript">
	$(document).ready(function() {
		
		$('#addsizes').on('click', addsize);

		function addsize() {
		  var new_input = '<div class="row py-3 offset-1 extra-sizes"><div class="form-group col-4 pb-3"><label>Size*<span style="display: block;font-size: 10px; font-weight: 400">(eg. S,M,L,XL or 12,13,14)</span></label><input id="size" placeholder="eg: M" type="text" name="sizes[]" class="form-control size-inputs"></div><div class="form-group col-4 pb-3"><label>Size Quantity*<span style="display: block;font-size: 10px; font-weight: 400">(Available quantity of this size?)</span></label><input id="sizes_qty" placeholder="eg: 12" type="number" name="sizes_qty[]" class="form-control size-inputs" min="0"></div><div class="form-group col-4 pb-3"><label>Size Price*<span style="display: block;font-size: 10px; font-weight: 400">(Price in numbers)</span></label><input id="sizes_price" placeholder="eg: 1000" type="number" min="0" name="sizes_price[]" class="form-control size-inputs"></div><span class="delete-options">&#10006;</span></div>';

		  $('.addmoresizes').append(new_input);
		  $('.size-inputs').attr('required','required');
		}


		$('#addwsale').on('click', addsale);

		function addsale() {
		  var new_input = '<div class="row py-3 offset-1 extra-wholesales"><div class="form-group col-4"><label>Quantity*<span style="display: block;font-size: 10px; font-weight: 400">(Wholesale quantity in number)</span></label><input  placeholder="eg: 12" type="number" name="whole_sale_qty[]" class="form-control whole-inputs pb-3" min="0"></div><div class="form-group col-4"><label>Unit*<span style="display: block;font-size: 10px; font-weight: 400">(Select wholesale unit)</span></label><select class="form-control" name="whole_sale_unit[]"><?php foreach(App\WholeSaleUnit::all() as $u){?><option value="<?=$u->unit?>"><?=$u->unit?></option><?php } ?></select></div><div class="form-group col-4"><label>Price*<span style="display: block;font-size: 10px; font-weight: 400">(Price in number only*)</span></label><input  placeholder="eg: 10000" type="number" min="0" name="whole_sale_price[]" class="form-control whole-inputs pb-3"></div><span class="delete-options">&#10006;</span></div>';

		  $('.addmorewholesales').append(new_input);
		  $('.whole-inputs').attr('required','required');
		}


	    $('#addcolor').on('click', addcolor);

		function addcolor() {
		  var new_input = '<div class="row py-3 offset-1 extra-colors"><div class="form-group col-4"><label>Color Name*<span style="display: block;font-size: 10px; font-weight: 400">(Type color name)</span></label><input id="color_name" placeholder="eg: Black" type="text" name="colors_name[]" class="form-control color-inputs"></div><div class="form-group col-4"><label>Color*<span style="display: block;font-size: 10px; font-weight: 400">(Select color or type color code)</span></label><div class="input-group color-code-section mb-3"><div class="input-group-prepend"><input type="color" class="form-control color-code-picker" style="padding: 0px;height: auto;width: 30px;"></div> <input id="color_code" placeholder="eg: #000000" type="text" name="colors[]" class="form-control color-code color-inputs"></div></div><div class="form-group col-4"><label>Color Quantity*<span style="display: block;font-size: 10px; font-weight: 400">(Available quantity of this color?)</span></label><input id="color_qty" placeholder="eg: 12" type="number" name="colors_qty[]" class="form-control color-inputs" min="0"></div><span class="delete-options">&#10006;</span></div>';

		  $('.addmorecolors').append(new_input);
		  $('.color-inputs').attr('required','required');
		}

	});
	$(document).on('click','.delete-options',function () {
		$(this).parent('.row').remove();
	})

</script>
@endsection