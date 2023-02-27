@extends("layouts.admin.app")
@section('content')
<div class="container">
	<form action="javascript:void(0)" class="row" method="POST" enctype="multipart/form-data" id="upload_product">
		<div class="bg-white p-5 col-xl-8 col-lg-8 col-md-8 col-sm-12 shadow-lg">
			<div class="pb-4">	
			<h1 >{{__('Upload Product')}}</h1>
				<p style="color: red; font-size: 12px;"><b>{{__('Note')}}:</b> {{__('All prices are in SR Currency format, Please  fill prices only in numbers*')}}</p>
			</div>
			<div class="alert alert-danger" id="msg" style="display: none;"></div>
			@csrf
			<div class="form-group">
				<label>{{__('Product Name*')}}</label>
				<input type="text"  class="form-control" name="name" required>
			</div>
			<div class="form-group">
				<label>{{__('Product Sku')}}*</label>
				<input type="text" value="{{$sku}}" class="form-control" id="sku" name="sku" required>
			</div>
			<div class="form-group">
				<label>
				<input id="condition" type="checkbox" name="condition_input">
					{{__('Add Product Condition')}}
				</label>
			</div>
			<div class="form-group" id="condition-show" style="display: none;">
				<label>{{__('Product Condition')}}</label>
				<select name="condition" class="form-control">
					<option value="new" selected>{{__('New')}}</option>
					<option value="used">{{__('Used')}}</option>
				</select>
			</div>
			<div class="form-group">
				<label>{{__('Category')}}*</label>
				<select name="category" id="category" class="form-control category" required>
					<option value="">{{__('Select Category')}}</option>
					@foreach($categories as $category)
						<option value="{{$category->id}}" data-url="{{route('admin.categorysubcategory.options',$category->id)}}">{{$category->name}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label>{{__('Sub Category*')}}</label>
				<select name="subcategory" id="subcategory" class="form-control subcategory" disabled>
					<option value="">{{__('Select Sub Category')}}</option>
				</select>
			</div>
			<div class="form-group">
				<label>{{__('Child Category*')}}</label>
				<select name="childcategory" id="childcategory" class="form-control childcategory" disabled>
					<option value="">{{__('Select Child Category')}}</option>
				</select>
			</div>
			<div class="attrs-container mt-4 mb-4">
				<div class="form-group">
					<div id="category_attributes"></div>
				</div>
				<div class="form-group">
					<div id="subcategory_attributes"></div>
				</div>
				<div class="form-group">
					<div id="childcategory_attributes"></div>
				</div>
			</div>
			<div class="form-group">
				<label>
				<input id="size" type="checkbox" name="size_input">
					{{__('Add Product Sizes')}}
				</label>
			</div>
			<div class="form-group" id="size-show" style="display: none;">
				<div class="row py-3 offset-1">
					<div class="form-group col-4 pb-3">
						<label>{{__('Size*')}}
							<span style="display: block;font-size: 10px; font-weight: 400">
								{{__('(eg. S,M,L,XL or 12,13,14)')}}
							</span>
						</label>
						<input id="size" placeholder="eg: M" type="text" name="sizes[]" class="form-control size-inputs">
					</div>
					<div class="form-group col-4 pb-3">
						<label>{{__('Size Quantity*')}}
							<span style="display: block;font-size: 10px; font-weight: 400">
								
								{{__('(Available quantity of this size?)')}}
							</span>
						</label>
						<input id="sizes_qty" placeholder="eg: 12" type="number" name="sizes_qty[]" min="0" class="form-control size-inputs">
					</div>
					<div class="form-group col-4 pb-3">
						<label>{{__('Size Price*')}}
							<span style="display: block;font-size: 10px; font-weight: 400">
								{{__('(Price in numbers)')}}
							</span>
						</label>
						<input id="sizes_price" placeholder="eg: 1000" type="number" name="sizes_price[]" min="0" class="form-control size-inputs">
					</div>
				</div>
				<div class="addmoresizes"></div>

				<div class=" pt-2 text-center">
					<button type="button" id="addsizes" class="btn btn-primary btn-sm"><i class="mdi mdi-plus"></i> {{__('Add Size')}}</button>
				</div>
			</div>
			<div class="form-group">
				<label>
				<input id="color" type="checkbox" name="color_input">
					{{__('Add Product Colors')}}
				</label>
			</div>
			<div class="form-group" id="color-show" style="display: none;">
				<div class="row py-3 offset-1">
					<div class="form-group col-4">
					<label>{{__('Color Name*')}}
							<span style="display: block;font-size: 10px; font-weight: 400">
								{{__('(Type color name)')}}
							</span>
					</label>
					<input id="color_name" placeholder="eg: Black" type="text" name="colors_name[]" class="form-control color-inputs">
					</div>
					<div class="form-group col-4">
					<label>{{__('Color*')}}
							<span style="display: block;font-size: 10px; font-weight: 400">
								{{__('(Select color or type color code)')}}
							</span>
					</label>
					<div class="input-group color-code-section mb-3">
						<div class="input-group-prepend">
				            <input type="color" class="form-control color-code-picker" style="padding: 0px;height: auto;width: 30px;">
			        	</div>
					  <input id="color_code" placeholder="eg: #000000" type="text" name="colors[]" class="form-control color-code color-inputs">
					</div>
					</div>
					<div class="form-group col-4">

					<label>{{__('Color Quantity*')}}
						<span style="display: block;font-size: 10px; font-weight: 400">
								{{__('(Available quantity of this color?)')}}
							</span>
					</label>
					<input id="color_qty" placeholder="eg: 12" min="0" type="number" name="colors_qty[]" class="form-control color-inputs">
					</div>
				</div>
				<div class="addmorecolors"></div>
				<div class=" pt-2 text-center">
					<button type="button" id="addcolor" class="btn btn-primary btn-sm"><i class="mdi mdi-plus"></i> {{__('Add Color')}}</button>
				
				</div>
			</div>
			<div class="form-group">
				<label>
				<input id="sale" type="checkbox" name="wholesale_input">
					{{__('Add Whole Sale')}}
				</label>
			</div>
			<div class="form-group" id="sale-show" style="display: none;">
				<div class="row py-3 offset-1">
					<div class="form-group col-4">
					<label>{{__('Quantity*')}}
							<span style="display: block;font-size: 10px; font-weight: 400">
								{{__('(Wholesale quantity in number)')}}
							</span>
					</labels>
						<input  placeholder="eg: 12" type="number" name="whole_sale_qty[]" class="form-control whole-inputs pb-3" min="0">
					</div>
					<div class="form-group col-4">
						<label>{{__('Unit*')}}
								<span style="display: block;font-size: 10px; font-weight: 400">
								{{__('(Select wholesale unit)')}}
								</span>
						</label>
						<select class="form-control" name="whole_sale_unit[]">
							@foreach(App\WholeSaleUnit::all() as $u)
							<option value="{{$u->unit}}">{{__($u->unit)}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group col-4">
					<label>{{__('Price*')}}
							<span style="display: block;font-size: 10px; font-weight: 400">
								{{__('(Price in number only*)')}}
							</span>
					</label>
						<input  placeholder="eg: 10000" type="number" min="0" name="whole_sale_price[]" class="form-control whole-inputs pb-3">
					</div>
				</div>
				<div class="addmorewholesales"></div>
				<div class=" pt-2 text-center">
					<button type="button" id="addwsale" class="btn btn-primary btn-sm"><i class="mdi mdi-plus"></i> {{__('Add Wholesale')}}</button>
					
				</div>
			</div>
			<div class="form-group">
				<label>{{__('Product Short Description*')}}</label>
				<textarea class="form-control" rows="10" name="short_description" placeholder="eg: lorem ipusm is dummy text ....." required></textarea>
			</div>
			<div class="form-group">
				<label>{{__('Product Description*')}}</label>
				<input id="x" type="hidden"  style="z-index: -99" class="form-control" name="description"  required>
					<trix-editor input="x"></trix-editor>
			</div>
			
		</div>
		<div class="bg-white  shadow-lg col-xl-3 col-lg-3 col-md-12 col-sm-12  offset-lg-1">
			<div class="form-group">
				<label class="pt-3">{{__('Product Thumbnail*')}}</label>
				<!-- <img id="blah" class="img-responsive" src="" width="100%" /> -->
				<div class="text-center">
					<input type="file" class="drop-image" accept="image/*" name="product_thumbnail" placeholder="Choose Image" data-allowed-file-extensions="jpeg png jpg gif" required>
				</div>
			</div>
			<div class="form-group">
				<label class="pt-3">{{__('Product Images')}}
				<span style="display: block;font-size: 10px; font-weight: 400">
					{{__('(Choose multiple images*)')}}
				</span>
				</label>
				<div >
					<button type="button" class="btn rounded-0 btn-primary" data-toggle="modal" data-target="#images-modal"><i class="mdi mdi-library-plus"></i>{{__(' Upload Images')}}</button>
				</div>
				<div class="modal fade" id="images-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-lg">
				    <div class="modal-content" style="cursor: pointer;">
				    	<div class="modal-header">
				    		<h3 class="modal-heading">{{__('Drop Images')}}<small class="text-muted" style="font-size: 12px"> {{__('(below section)')}}</small></h3>
				    	</div>
				    	<div class="input-images"></div>
						<div class="modal-footer">
					    	<button type="button" data-dismiss="modal" class="btn btn-danger btn-sm">{{__('Close')}}</button>
					    	<button type="button" data-dismiss="modal" class="btn btn-dark btn-sm">{{__('Done')}}</button>
					    </div>
				    </div>
				    
				  </div>
				</div>
			</div>
			<div class="form-group">
				<label>{{__('Product Price*')}}
					<span style="display: block;font-size: 10px; font-weight: 400">
						{{__('(Price must be in number)')}}
					</span>
				</label>
			<input type="number" class="form-control" maxlength="11"  name="price" placeholder="eg: 1000" required>
			</div>
			<div class="form-group">
				<label>{{__('Product Old Price')}}
					<span style="display: block;font-size: 10px; font-weight: 400">
						{{__('(Price must be in number)')}}
					</span>
				</label>
				<input type="number" class="form-control"  name="old_price" placeholder="eg: 1000">
			</div>
			<div class="form-group">
				<label>{{__('Product Stock*')}}
					<span style="display: block;font-size: 10px; font-weight: 400">
						{{__('(Product stock in number)')}}
					</span>
				</label>
				<input type="number"  class="form-control" name="stock" placeholder="eg: 50" required>
			</div>
			<div class="form-group">
				<label>{{__('Product Tags')}}
					<span style="display: block;font-size: 10px; font-weight: 400">
						{{__('(Add comma after every keyword)')}}
					</span>
				</label>
				<input type="text" id="tags" name="tags[]" class="form-control" placeholder="eg: Bag, Black Bag etc ..." />
			</div>	
		</div>
		<div class="bg-white p-5 col-xl-12 col-lg-8 col-md-8 col-sm-12 shadow-lg" style="margin-top: 1%">
			<div class="form-group">
				<label>
				<input id="seo" type="checkbox" name="seo_input">
					{{__('Add Seo')}}
				</label>
			</div>
			<div id="seo-show" style="display: none;">
				<div class="form-group">
					<label>{{__('Seo Title')}}
						<span style="display: block;font-size: 10px; font-weight: 400">
							{{__('(Product Page title)')}}
						</span>
					</label>
					<input type="text" id="seo_title" class="form-control seo-inputs" name="seo_title" />
				</div>
				<div class="form-group">
					<label>{{__('Meta Keywords')}}
						<span style="display: block;font-size: 10px; font-weight: 400">
							{{__('(Add comma after every keyword*)')}}
						</span>
					</label>
					<input type="text" id="meta_tags" class="seo-inputs" name="meta_tags[]" class="form-control" />
				</div>
				<div class="form-group">
					<label>{{__('Meta Description')}}
						<span style="display: block;font-size: 10px; font-weight: 400">
							{{__('(Avoid long description*)')}}
						</span>
					</label>
					<textarea rows="10" class="form-control" class="seo-inputs" name="meta_description"></textarea>
				</div>
			</div>
			<div class="form-group pt-5">
				<button type="submit" class="btn btn-primary btn-lg float-right" id="submit-btn"> {{__('UPLOAD')}}</button>
			</div>
		</div>
	</form>
</div>
@endsection
@section('javascript')
<script type="text/javascript">


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
	// Product thumbnail
	$('.drop-image').dropify();

	// Product Images
	$('.input-images').imageUploader({Default: ['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml']});

	$(document).on('mouseup change','.color-code-picker',function(){
		var color_code_section = $(this).parent('div').parent('.color-code-section');
		color_code_section.children(".color-code").val($(this).val());
	});

	$('#upload_product').submit(function(event) {
		event.preventDefault();
		    $.ajax({
		        url: '{{ route("products.store") }}',
		        type: 'POST',              
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
		        		$("#upload_product")[0].reset();
		            	set_new_Sku();
		            	$('#condition-show').hide();
		            	$('#sale-show').hide();
		            	$('#size-show').hide();
		            	$('#color-show').hide();
		            	$('#seo-show').hide();
		            	$("#category_attributes").html('');
						$("#subcategory_attributes").html('');
						$("#childcategory_attributes").html('');
						$("#childcategory").attr('disabled','disabled');
						$("#subcategory").attr('disabled','disabled');
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
	    $('#condition-show').hide();
		    $('#condition').on('click', function () {
		        if ($(this).prop('checked')) {
	           	 	$('#condition-show').fadeIn();
		        } else {
		            $('#condition-show').hide();
		        }
	    });
		$('#sale-show').hide();
	    $('#sale').on('click', function () {
	        if ($(this).prop('checked')) {
	        	$('.whole-inputs').attr('required','required');
           	 	$('#sale-show').fadeIn();
	        } else {
	        	$('.whole-inputs').removeAttr('required');
	            $('#sale-show').hide();
	        }
	    });
	    $('#size-show').hide();
	    $('#size').on('click', function () {
	        if ($(this).prop('checked')) {
	        	$('.size-inputs').attr('required','required');
           	 	$('#size-show').fadeIn();
	        } else {
	        	$('.size-inputs').removeAttr('required');
	            $('#size-show').hide();
	        }
	    });
	    $('#color-show').hide();
	    $('#color').on('click', function () {
	        if ($(this).prop('checked')) {
	        	$('.color-inputs').attr('required','required');
           	 	$('#color-show').fadeIn();
	        } else {
	        	$('.color-inputs').removeAttr('required');
	            $('#color-show').hide();
	        }
	    });
	    $('#seo-show').hide();
	    $('#seo').on('click', function () {
	        if ($(this).prop('checked')) {
	        	$('.seo-inputs').attr('required','required');
           	 	$('#seo-show').fadeIn();
	        } else {
	        	$('.seo-inputs').removeAttr('required');
	            $('#seo-show').hide();
	        }
	    });
	   
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