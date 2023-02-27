@extends('layouts.admin.app')
@section('content')
<div class="py-4"></div>
<div class="container bg-white rounded-pill p-5">
	<h1>{{__('Edit Faq')}}</h1>
	<div class="form-content  p-3">
		<form method="post" action="{{route('faqs.update',$faq->id)}}">
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
				<label>{{__('Faq Title')}}</label>
				<input type="text" class="form-control rounded-0" value="{{__($faq->title)}}" name="title" required>
			</div>
			<div class="form-group">
				<label>{{__('Faq Detail')}}</label>
				<input id="x" type="hidden" name="detail" value="{!! $faq->detail !!}">
				<trix-editor input="x"></trix-editor>
			</div>
			<button type="submit" class="btn btn-primary rounded-0 float-right">{{__('UPDATE')}}</button>
		</form>
	</div>
</div>
@endsection