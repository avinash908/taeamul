@extends('layouts.vendor.app')
@section('content')
<div class="py-4"></div>
<div class="container bg-white rounded-pill p-5">
  <h1>{{__('Account Settings')}}</h1>
  @if ($errors->any())
          <ul class="alert alert-danger">
              @foreach($errors->all() as $error)
                <li>  
                  {{__($error)}}</li>
              @endforeach
          </ul>
      @endif
  <div class="row">
    
    <div class="col-md-6">
      <div class="form-content  p-3">
        <form method="post" action="{{route('v-settings.change.password')}}">
         @csrf
        <div class="form-group">
          <label>{{__('Current Password')}}</label>
          <input type="password" name="current_password" value="{{ old('current_password') }}" class="form-control @error('current_password') is-invalid @enderror" required>
          @if($errors->has('current_password'))
              @foreach($errors->get('current_password') as $message)
                <span style="color:red">{{__($message)}}</span>
              @endforeach
           @endif
        </div>
        <div class="form-group">
          <label>{{__('New Password')}}</label>
          <input type="password" name="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" id="password" required>
          @if($errors->has('password'))
              @foreach($errors->get('password') as $message)
                <span style="color:red">{{__($message)}}</span>
              @endforeach
          @endif
        </div>
        <div class="form-group">
          <label>{{__('Confirm Password')}}</label>
          <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}"  class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" required>
          @if($errors->has('password_confirmation'))
              @foreach($errors->get('password_confirmation') as $message)
                <span style="color:red">{{__($message)}}</span>
              @endforeach
          @endif
        </div>
        <button class="btn btn-primary float-right" type="submit">{{__('Save Changes')}}</button>
        </form>
      </div>
    </div>
    <div class="col-md-6">
      @if(session()->has('email_changed'))
      <div class="alert alert-success">{{__(session()->get('email_changed'))}}</div>
      @else
      <form action="{{route('v-settings.change.email')}}" method="POST">
        @csrf
        <div class="row">
           <div class="col-md-12">
            <div class="form-group">
               <label for="email">{{__('Email')}}</label>
               <input type="email" name="email" id="current_password" class="form-control" value="{{Auth::user()->email}}" required>
               @if($errors->has('email'))
                  @foreach($errors->get('email') as $message)
                    <span style="color:red">{{__($message)}}</span>
                  @endforeach
               @endif
            </div>
           </div>
           <div class="col-md-12">
            <div class="form-group text-right">
              <button type="submit" class="ps-btn btn btn-primary mt-20">{{__('Change Email')}}</button>
            </div>
           </div>
        </div>
      </form>
      @endif
    </div>
  </div>
</div>
@endsection