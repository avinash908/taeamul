@extends('layouts.admin.auth')
@section('content')
<div class="row w-100">
<div class="col-lg-4 mx-auto">
  <div class="auth-form-light text-left p-5">
    <h4>{{__('Admin')}}</h4>
    <h6 class="font-weight-light">{{ $title }}</h6>
    @if(session()->has('danger'))
    <div class="alert alert-danger">
      {{session()->get('danger')}}
    </div>
    @endif
    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li>{{ __($error) }}</li>
            @endforeach
        </ul>
    @endif
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <form action="{{ route($passwordEmailRoute) }}" method="POST" class="pt-3" id="admin-login">
      @csrf
      <div class="form-group">
        <input id="email" type="email" class="form-control form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required>
        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ __($errors->first('email')) }}</strong>
            </span>
        @endif
      </div>
      <div class="mt-3">
        <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn t_submit" type="submit">{{ __('Send Password Reset Link') }}</button>
      </div>
      <div class="my-2 d-flex justify-content-between align-items-center">
        <div class="form-check"> </div>
        <a href="{{route('admin.login')}}" class="auth-link text-black">{{__('Login')}}</a>
      </div>
    </form>
  </div>
</div>
</div>
@endsection