@extends('layouts.front.app')
@section('title',env('APP_Name') . ' - Verify Email' )
@section('content')

<div id="primary" class="content-area container">
    <main id="main" class="site-main">
        <article id="post-8" class="hentry">

        <div class="entry-content">
            <div class="woocommerce">
                <div class="customer-login-form">
                    <div class="col-2" style="text-align: center;margin-top: 6%;line-height: 2.6;">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif
                        <div class="alert alert-warning" >  
                            {{ __('Before proceeding, please check your email for a verification link.') }}
                            {{ __('If you did not receive the email') }},
                        </div>
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Click here to request another') }}</button>.
                        </form>
        </div><!-- .col-2 -->
            </div><!-- .col-2 -->
                   </div><!-- /.customer-login-form -->
                        </div><!-- .entry-content -->

                            </article><!-- #post-## -->

                        </main><!-- #main -->
                    </div><!-- #primary -->
@endsection
