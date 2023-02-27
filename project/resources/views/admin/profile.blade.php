@extends('layouts.admin.app')
@section('content')
<div class="container">
  <div class="bg-white p-5 col-xl-12 col-lg-12 col-md-12 col-sm-12 shadow-lg">
    <h1 class="pb-4">{{__('Profile')}}</h1>
      <form action="{{route('admin.profile.update')}}" method="POST" enctype="multipart/form-data">
        <div class="row">
        	<div class="col-md-3">
        		<input type="file" class="drop-image" data-allowed-file-extensions="jpeg png jpg gif" data-default-file="{{asset($user->avatar)}}" name="image">
        	</div>
        	<div class="col-md-9">
              @csrf
              <div class="row">
                @if ($errors->any())
                  <hr/>
                  <ul class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <li>{{__($error) }}</li>
                    @endforeach
                  </ul>
                @endif
              <div class="col-md-6">
            		<div class="form-group">
                  <label>{{__('Name')}}</label>
                  <input type="text" name="name" class="form-control" value="{{$user->name}}" required>
                </div>
              </div>
              <div class="col-md-6">           
                <div class="form-group">
                  <label>{{__('Email')}}</label>
                  <input type="email" class="form-control" value="{{$user->email}}" disabled>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>{{__('Phone')}}</label>
                  <input type="text" name="phone" class="form-control" value="{{$user->phone}}" required>
                </div>
              </div>
              <div class="col-md-6">
              <!-- <div class="form-group"> -->
                   <button type="submit" class="btn btn-primary float-right mt-4" style="margin: 1rem;">{{__('UPDATE')}}</button>
              <!-- </div> -->
              </div>
            </div>
        	</div>
        </div>
      </form>
  </div>
</div>
@endsection
@section('javascript')
<script type="text/javascript">
  $('.drop-image').dropify();
</script>
@endsection