@extends('layouts.front.app')
@section('title',env('APP_Name') . ' - Reset Password' )
@section('content')

<div style="margin:10rem 0px"></div>


<div id="primary" class="content-area container">
    <main id="main" class="site-main">
        <article id="post-8" class="hentry">

            <div class="entry-content">
                <div class="woocommerce">
                    <div class="customer-login-form">
                        <div class="col2-set">
                            <div class="col-2 t_col-2" >


                                 @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                  <form method="POST" action="{{ route('password.email') }}">
                                    @csrf
                                    <h3 class="before-login-text">{{ __('Reset Password') }}</h3>

                                    <p class="form-row form-row-wide">
                                        <label for="email" class="required">{{ __('E-Mail Address') }}</label>
                                           <input id="email" placeholder="Write Your Email Address" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </p>
                                        <p class="form-row">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Send Password Reset Link') }}
                                            </button>
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
