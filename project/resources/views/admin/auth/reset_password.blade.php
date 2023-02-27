@extends('layouts.admin.auth')
@section('content')
<div class="row w-100">
<div class="col-lg-4 mx-auto">
  <div class="auth-form-light text-left p-5">
    <h4>{{__("Admin")}}</h4>
    <h6 class="font-weight-light">{{ __('Admin Reset Password') }}</h6>
    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li>{{ __($error) }}</li>
            @endforeach
        </ul>
    @endif
    <form action="{{ route('admin.reset.password') }}" method="POST" class="pt-3" id="admin-login">
       @csrf
      <input type="hidden" name="token" value="{{ $token }}">
      
      <div class="form-group">
        <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" id="exampleInputEmail1" value="{{ $email ?? old('email') }}" placeholder="Email">
         @if ($errors->has('email'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ __($errors->first('email')) }}</strong>
              </span>
          @endif
      </div>
      <div class="form-group">
        <input type="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" id="exampleInputPassword1" placeholder="Password" required>
         @if ($errors->has('password'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
          @endif
      </div>
      <div class="form-group">
        <input id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation" placeholder="Confirm Password" required>
      </div>
      <div class="mt-3">
        <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn t_submit" type="submit">{{ __('Reset Password') }}</button>
      </div>
    </form>
  </div>
</div>
</div>
@endsection