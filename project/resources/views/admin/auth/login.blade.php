@extends('layouts.admin.auth')
@section('content')
<div class="row w-100">
<div class="col-lg-4 mx-auto">
  <div class="auth-form-light text-left p-5">
    <h4>{{__("Admin")}}</h4>
    <h6 class="font-weight-light">{{__("Sign in to continue.")}}</h6>
    @if(session()->has('danger'))
    <div class="alert alert-danger">
      {{__(session()->get('danger'))}}
    </div>
    @endif
    @if ($errors->any())
    <hr/>
        <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li>{{ __($error) }}</li>
            @endforeach
        </ul>
    @endif
    <form action="{{route('admin.do_login')}}" method="POST" class="pt-3" id="admin-login">
      @csrf
      <div class="form-group">
        <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" id="exampleInputEmail1" value="{{old('email')}}" placeholder="Email">
        @error('email')
          <span class="invalid-feedback" role="alert">
              <strong>{{ __($message) }}</strong>
          </span>
        @enderror
      </div>
      <div class="form-group">
        <input type="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" id="exampleInputPassword1" placeholder="Password">
        @error('password')
          <span class="invalid-feedback" role="alert">
              <strong>{{ __($message) }}</strong>
          </span>
        @enderror
      </div>
      <div class="mt-3">
        <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn t_submit" type="submit">{{__('SIGN IN')}}</button>
      </div>
      <div class="my-2 d-flex justify-content-between align-items-center">
        <div class="form-check">
          <label class="form-check-label text-muted">
            <input type="checkbox" class="form-check-input" name="remember">
            {{__("Keep me signed in")}}
          </label>
        </div>
        <a href="{{route('admin.reset.password')}}" class="auth-link text-black">{{__("Forgot password?")}}</a>
      </div>
    </form>
  </div>
</div>
</div>
@endsection