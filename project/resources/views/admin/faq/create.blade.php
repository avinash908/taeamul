@extends('layouts.admin.app')
@section('content')
<div class="py-4"></div>
<div class="container bg-white rounded-pill p-5">
	<h1>{{__('Add New Faq')}}</h1>
	<div class="form-content  p-3">
		<form method="post" action="{{route('faqs.store')}}">
			@if ($errors->any())
		        <ul class="alert alert-danger">
		            @foreach($errors->all() as $error)
		                <li>{{ __($error) }}</li>
		            @endforeach
		        </ul>
		    @endif
			@csrf
			<div class="form-group">
				<label>{{__('Faq Title')}}</label>
				<input type="text" class="form-control rounded-0" value="{{old('title')}}" placeholder="eg: What Shipping Methods Are Available?" name="title" required>
			</div>
			<div class="form-group">
				<label>{{__('Faq Detail')}}</label>
				<input id="x" type="hidden" name="detail" value="{{ old('detail') }}">
				<trix-editor input="x"></trix-editor>
			</div>
			<button type="submit" class="btn btn-primary rounded-0 float-right">{{__('Save')}}</button>
		</form>
	</div>
</div>
@endsection