@extends('layouts.admin.app')
@section('content')
<div class="py-4"></div>
<div class="container bg-white rounded-pill p-5">
	<h1>{{__('Edit Seo')}}</h1>
	<div class="form-content  p-3">
		<form method="post" action="{{route('admin.seo.update',$seo->id)}}">
			@if ($errors->any())
		        <ul class="alert alert-danger">
		            @foreach($errors->all() as $error)
		                <li>{{ __($error) }}</li>
		            @endforeach
		        </ul>
		    @endif
			@csrf
			<div id="seo-show">
				<div class="form-group">
					<label>{{__('Seo Title')}}
						<span style="display: block;font-size: 10px; font-weight: 400">
							{{__('(Page title)')}}
						</span>
					</label>
					<input type="text" value="{{ $seo->title }}" id="seo_title" class="form-control seo-inputs" name="seo_title" />
				</div>
				<div class="form-group">
					<label>{{__('Meta Keywords')}}
						<span style="display: block;font-size: 10px; font-weight: 400">
							{{__('(Add comma after every keyword*)')}}
						</span>
					</label>
						                           
		                  	 <input type="text" id="meta_tags" value="
		                  	@if($seo->meta_tags)
		                   		 @foreach($seo->meta_tags as $tag)
		                   		 {{$tag}}
		                   		 @endforeach
		                    @endif
		                  	 "  name="meta_tags[]" class="form-control seo-inputs" />                                       
		                    
				</div>
				<div class="form-group">
					<label>{{__('Meta Description')}}
						<span style="display: block;font-size: 10px; font-weight: 400">
							{{__('(Avoid long description*)')}}
						</span>
					</label>
					<textarea rows="10" class="form-control" class="seo-inputs" name="meta_description">{{ $seo->meta_description }}</textarea>
				</div>
			</div>
			<button type="submit" class="btn btn-primary rounded-0 float-right">{{__('Create')}}</button>
		</form>
	</div>
</div>
@endsection