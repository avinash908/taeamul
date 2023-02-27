@extends('layouts.admin.app')
@section('content')
<div class="container">
  <div class="bg-white p-5 col-xl-12 col-lg-12 col-md-12 col-sm-12 shadow-lg">
    <h1 class="pb-4">{{__('Edit Customer')}}</h1>
      <form action="{{route('admin.customers.update',$user->id)}}" method="POST" enctype="multipart/form-data">
        <div class="row">
        	<div class="col-md-3">
        		<input type="file" class="drop-image" data-allowed-file-extensions="jpeg png jpg gif" data-default-file="{{url('/').'/'.$user->image->url}}" name="pic">
        	</div>
        	<div class="col-md-9">
              @csrf
              <div class="row">
                @if ($errors->any())
                  <hr/>
                  <ul class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <li>{{ __($error) }}</li>
                    @endforeach
                  </ul>
                @endif
              <div class="col-md-6">
            		<div class="form-group">
                  <label>{{__('Name')}}</label>
                  <input type="text" name="name" class="form-control" value="{{__($user->name)}}" required>
                </div>
              </div>
              <div class="col-md-6">           
                <div class="form-group">
                  <label>{{__('Email')}}</label>
                  <input type="email" name="email" class="form-control" value="{{$user->email}}" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>{{__('Phone')}}</label>
                  <input type="text" name="phone" class="form-control" value="{{$user->phone}}" required>
                </div>
              </div>
              <div class="col-md-6">
                
                <div class="form-group">
                  <label>{{__('Address')}}</label>
                  <textarea  name="address" class="form-control" required>{{$user->address}}</textarea>
                </div>
              </div>
              <div class="col-md-6">
                
                <div class="form-group">
                  <label>{{__('City')}}</label>
                  <input type="text" name="city" class="form-control" value="{{__($user->city)}}" required>
                </div>
              </div>
              <div class="col-md-6">
                
                <div class="form-group">
                  <label>{{__('Postal Code/Zip')}}</label>
                  <input type="text" name="zip" class="form-control" value="{{$user->zip}}" required>
                </div>
              </div>
                <div class="col-md-12 text-right">
                <button type="submit" class="btn btn-primary">{{__('UPDATE')}}</button>
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