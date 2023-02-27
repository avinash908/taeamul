@extends('layouts.front.app')
@section('title',env('APP_Name') . ' - Reset Password' )
@section('content')


<div id="primary" class="content-area container">
<main id="main" class="site-main">
    <article id="post-8" class="hentry">

        <div class="entry-content">
            <div class="woocommerce">
                <div class="customer-login-form">

                    <div class="col2-set " >
                        <div class="col-2 t_col-2">
                <h1 style="text-align: center">{{ __('Reset Password') }}</h1>
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <p class="form-row">
                            <label for="email">{{ __('E-Mail Address') }}</label>

                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </p>

                        <p class="form-row">
                            <label for="password">{{ __('Password') }}</label>

                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </p>

                        <p class="form-row">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>

                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </p>

                        <p class="form-row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </p>
                    </form>
              </div><!-- .col-2 -->

                                            </div><!-- .col2-set -->
</div>
                                        </div><!-- /.customer-login-form -->
                                </div><!-- .entry-content -->

                            </article><!-- #post-## -->

                        </main><!-- #main -->
                    </div><!-- #primary -->

@endsection
