@extends('layouts.front.app')
@include('front.includes.seo')
@section('content')
   <div id="content" class="site-content" tabindex="-1">
                <div class="container">

                    <nav class="woocommerce-breadcrumb" >
                        <a href="{{url('/')}}">{{__('Home')}}</a>
                        <span class="delimiter"><i class="fa fa-angle-right"></i></span>
                        {{__('Contact')}}
                    </nav><!-- .woocommerce-breadcrumb -->

                    <div id="primary" class="content-area">
                        <main id="main" class="site-main">

                            <article class="hentry">

                                <header class="entry-header">
                                    <h1 class="entry-title">{{__('Contact')}}</h1>
                                </header><!-- .entry-header -->

                                <div class="entry-content">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="wpb_wrapper outer-bottom-xs">
                                                <h2 class="contact-page-title">{{__('Leave us a Message')}}</h2>
                                                <p>{{__($contact_detail->info)}}</p>

                                            </div>

                                            <div role="form" class="wpcf7">
                                                <div class="screen-reader-response"></div>
                                                <form action="#" method="post" class="wpcf7-form">

                                                    <div class="form-group row">
                                                        <div class="col-xs-12 col-md-6">
                                                            <label>{{__('First name')}} *</label><br />
                                                            <span class="wpcf7-form-control-wrap first-name">
                                                                <input type="text" name="first-name"  size="40" class="wpcf7-form-control input-text" aria-required="true" aria-invalid="false" />
                                                            </span>
                                                        </div>

                                                        <div class="col-xs-12 col-md-6">
                                                            <label>{{__('Last name')}} *</label><br />
                                                            <span class="wpcf7-form-control-wrap last-name">
                                                                <input type="text" name="first-name" size="40" class="wpcf7-form-control input-text" aria-required="true" aria-invalid="false" />
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>{{__('Subject')}}</label><br />
                                                        <span class="wpcf7-form-control-wrap subject"><input type="text" name="subject" size="40" class="wpcf7-form-control input-text" aria-invalid="false" /></span>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>{{__('Your Message')}}</label><br />
                                                        <span class="wpcf7-form-control-wrap your-message"><textarea name="your-message" cols="40" rows="10" class="wpcf7-form-control input-text wpcf7-textarea" aria-invalid="false"></textarea></span>
                                                    </div>

                                                    <div class="form-group clearfix">
                                                        <p><input type="submit" value="Send Message" class="wpcf7-form-control wpcf7-submit" /></p>
                                                    </div>
                                                </form>
                                            </div>
                                        </div><!-- .col -->

                                        <div class="store-info store-info-v2 col-sm-6">
                                            <div class="vc_column-inner ">
                                                <div class="wpb_wrapper">
                                                    <div class="inner-left-xs outer-bottom-xs">

                                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2481.593303940039!2d-0.15470444843858283!3d51.53901886611164!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48761ae62edd5771%3A0x27f2d823e2be0249!2sPrincess+Rd%2C+London+NW1+8JR%2C+UK!5e0!3m2!1sen!2s!4v1458827996435" width="600" height="288" style="border:0" allowfullscreen></iframe>

                                                    </div>

                                                    <div class="inner-left-xs">
                                                        <div class="wpb_wrapper">
                                                            <h2 class="contact-page-title">{{__('Our Address')}}</h2>
                                                            <p>{{__($contact_detail->address)}}<br />
                                                                {{__('Support')}} {{$contact_detail->phone}}<br />
                                                                {{__('Email')}}: <a href="mailto:{{$contact_detail->email}}">{{$contact_detail->email}}</a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .col -->
                                    </div><!-- .row -->
                                </div><!-- .entry-content -->

                            </article><!-- #post-## -->

                        </main><!-- #main -->
                    </div><!-- #primary -->

                </div><!-- .col-full -->
            </div><!-- #content -->

           
      @include('front.includes.bottom-ads')

@endsection