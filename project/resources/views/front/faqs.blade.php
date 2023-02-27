@extends('layouts.front.app')
@include('front.includes.seo')
@section('content')

            <div id="content" class="site-content" tabindex="-1">
                <div class="container">
                    <nav class="woocommerce-breadcrumb"><a href="{{url('/')}}">{{__('Home')}}</a><span class="delimiter"><i class="fa fa-angle-right"></i></span>{{__('FAQ')}}</nav>

                    <div id="primary" class="content-area">
                        <main id="main" class="site-main">
                            <article class="page type-page status-publish hentry" >

                                <header class="entry-header">
                                    <h1 itemprop="name" class="entry-title">{{__('Frequently Asked Questions')}}</h1>
                                </header>
                                <!-- .entry-header -->

                                <div itemprop="mainContentOfPage" class="entry-content">
                                    <!-- <div class="vc_row wpb_row vc_row-fluid">
                                        <div class="wpb_column vc_column_container vc_col-sm-12">
                                            <div class="vc_column-inner ">
                                                <div class="wpb_wrapper"><h2 class="vc_custom_heading faq-page-title" style="font-size: 25px;color: #434343;text-align: left;font-family:Open Sans;font-weight:400;font-style:normal">{{__('Shipping Information')}}</h2></div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="vc_row wpb_row vc_row-fluid inner-bottom-xs" style="display: inline-block;">
                                        @foreach($faqs as $faq)
                                        <div class="wpb_column vc_column_container vc_col-sm-6 col-sm-6">
                                            <div class="vc_column-inner ">
                                                <div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element ">
                                                        <div class="wpb_wrapper">
                                                            <h3 style="text-align: left;" class="faq-title">{{__($faq->title)}}</h3>
                                                            <div class="text-content">
                                                               {!! __($faq->detail) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div><!-- .entry-content -->
                            </article>
                        </main><!-- #main -->
                    </div><!-- #primary -->
                </div><!-- .container -->
            </div><!-- #content -->
            @include('front.includes.bottom-ads')
@endsection