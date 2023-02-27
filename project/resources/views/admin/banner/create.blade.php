@extends('layouts.admin.app')
@section('content')
<div class="py-4"></div>
<div class="container bg-white rounded-pill p-5">
	<h1>{{__("Add New Banner")}}</h1>
	<div class="form-content  p-3">
		<form method="post" action="{{route('banners.store')}}" enctype="multipart/form-data">
			@if ($errors->any())
		        <ul class="alert alert-danger">
		            @foreach($errors->all() as $error)
		                <li>{{ __($error) }}</li>
		            @endforeach
		        </ul>
		    @endif
			@csrf
			<div class="form-group">
				<label class="pt-3">{{__('Image*')}}</label>
					<input type="file" class="drop-image" accept="image/*" name="image" placeholder="Choose Image" data-allowed-file-extensions="jpeg png jpg gif" required>
			</div>
			<div class="form-group">
				<label>{{__('Select Banner Postion*')}}<span style="font-size: 11px;color:red;"> {{__('(Click the link to see Banner Postions')}} : <a href="#" data-target="#preview_layout" data-toggle="modal">{{__('Layout')}}</a>)</span></label>
				<select name="position" class="form-control" required>
					<option value="top_silder">{{__('Top Slider')}}</option>
					<option value="top_widgets">{{__('Top Widgets')}}</option>
					<option value="middle">{{__('Middle')}}</option>
					<option value="left_side">{{__('Left Side')}}</option>
					<option value="right_side">{{__('Right Side')}}</option>
					<option value="bottom">{{__('Bottom')}}</option>
				</select>
			</div>
			<div class="form-group">
				<label>{{__('Banner Title*')}}</label>
				<input  type="text" class="form-control" value="{{old('title')}}" name="title" required>
			</div>
			<div class="form-group">
				<label>{{__('Banner Text*')}}<span style="font-size: 11px;">{{__('(Content)')}}</span></label>
				<input id="x" type="hidden"  style="z-index: -99" class="form-control" value="{{old('content')}}" name="content"  required>
				<trix-editor input="x"></trix-editor>
			</div>
			<div class="form-group">
				<label>{{__('Offer')}} <span style="font-size: 11px;">{{__('(optional')}})</span></label>
				<input type="text" class="form-control" value="{{old('offer')}}" name="offer" placeholder="eg: UPTO 70% OFF">
			</div>
			<div class="form-group">
				<label>{{__('Link')}}* <span style="font-size: 11px;">{{__('(link for redirection after click on banner button or text)')}}</span></label>
				<input type="text" name="link" class="form-control" placeholder="eg: https://wwww.taeamul.com/examplepage" required>
			</div>
			<button type="submit" class="btn btn-primary rounded-0 float-right">{{__('Save')}}</button>
		</form>
	</div>
</div>
<div class="modal fade bd-example-modal-lg show" id="preview_layout" role="dialog">
    <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- <div class="modal-body" id="dynamic-content"> -->
                    <img src="{{asset('assets/images/temp/layout.jpg')}}" class="img-fluid" alt=""/>
                <!-- </div> -->
            </div>
       </div>
</div> 

<a href="#myModal" role="button" class="btn btn-primary" data-toggle="modal">{{__('Launch modal')}}</a>
@endsection
@section('javascript')
<script type="text/javascript">
	$('.drop-image').dropify();
</script>
@endsection