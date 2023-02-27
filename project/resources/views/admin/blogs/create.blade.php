@extends('layouts.admin.app')

@section('content')
		
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/dropify.css')}}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/select2.css')}}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/jquery.tagsinput-revisited.css')}}">
		<script type="text/javascript" src="{{asset('assets/admin/js/jquery.tagsinput-revisited.js')}}"></script>

        <script src="https://cdn.tiny.cloud/1/sokyk3z608i7wzazq03wtdj2zj8b9ca57wckd7xc2d8ifsjp/tinymce/5/tinymce.min.js" referrerpolicy="origin"/></script>
        <script>

    tinymce.init({
      selector: '#mytextarea',
      setup: function (editor) {
        editor.on('change', function () {
            tinymce.triggerSave();
        });
	   }
    });

  </script>
  <style type="text/css">
	div.tagsinput span.tag {
    background: #282f3a !important;
    color: #ffffff;
    line-height: 1.4;
    padding: 8px 24px !important;
}
</style>
         @if ($errors->any())
        <hr/>
            <ul class="alert alert-danger list-unstyled">
                @foreach($errors->all() as $error)
                    <li>{{ __($error) }}</li>
                @endforeach
            </ul>
        @endif
	<div class="content">
		<div class="row">
			<div class="col-lg-11 bg-white p-5">
				<h2>{{__('Create Post')}}</h2>
				<div class="py-3"></div>
				<form id="createPostForm" action="{{route('admin.post.store')}}" method="post" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
						<div class="col-lg-12 grid-margin stretch-card">
			              <div class="card" style="box-shadow: none!important">
			                <div class="card-body">
			                  <h4 class="card-title d-flex">{{__('Posts Thumbnail')}}
			                    <small class="ml-auto align-self-end">
			                    </small>
			                  </h4>
			                  <input type="file" name="blogPic" data-min-width="100%" data-max-width="100%" class="dropify" />
			                </div>
			              </div>
			            </div>
					</div>
					<div class="form-group">
						<label>{{__('Post Title')}}</label>
						<input type="text" class="req form-control" name="title" >
					</div>
					<div class="form-group">
						<label>{{__('Post Data')}}</label>
						<textarea id="mytextarea" rows="30" name="dataSend"></textarea>

					</div>
					
					<div class="form-group">
						<label>{{__('Add Tags')}}</label>
						<input type="text" name="tags[]" id="tagsInput" class="form-control">
						
					</div>
					<div class="form-group">
						<label>{{__('Select Category')}}</label>
						<select name="categorySelect" class="form-control" required>
							<option selected="selected" disabled>{{__('Select Category')}}</option>
							@foreach($cat as $row)
								<option value="{{$row->id}}">{{__($row->title)}}</option>
							@endforeach
						</select>
					</div>
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
			
					<div class="form-group">
						<button type="submit" class="btn btn-block btn-primary">{{__('Post')}}</button>

					</div>
				</form>
			</div>
		</div>
	</div>

<script type="text/javascript">
	
</script>
  <script src="{{asset('assets/js/form-tags.js')}}"></script>
  <script src="{{asset('assets/js/select2.js')}}"></script>
  <script src="{{asset('assets/js/dropify.js')}}"></script>

@endsection

@section('javascript')
<script type="text/javascript">
	jQuery(document).ready(function () {
		jQuery('.dropify').dropify();
		jQuery(".select2").select2({
		    tags: true,
		    tokenSeparators: [',', ' ']
		})
		 $('#seo-show').hide();
	    $('#seo').on('click', function () {
	        if ($(this).prop('checked')) {
           	 	$('#seo-show').fadeIn();
	        } else {
	            $('#seo-show').hide();
	        }
	    });

	    $('#tagsInput').tagsInput({

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
	});
</script>
@endsection