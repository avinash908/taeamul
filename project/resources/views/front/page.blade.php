@extends('layouts.front.app')
@include('front.includes.seo')
@section('content')
            <div id="content" class="site-content" tabindex="-1">
                <div class="container">

                    <nav class="woocommerce-breadcrumb" >
                        <a href="{{url('/')}}">{{__('Home')}}</a>
                        <span class="delimiter"><i class="fa fa-angle-right"></i></span>
                        {{__($page->title)}}
                    </nav><!-- .woocommerce-breadcrumb -->


                    <div id="primary" class="content-area">
                        <main id="main" class="site-main">


                            <article id="post-2183" class="hentry">

                                <header class="entry-header">
                                    <h1 class="entry-title">{{__($page->title)}}</h1>
                                </header><!-- .entry-header -->

                                <div class="entry-content">{!! $page->content !!}</div><!-- .entry-content -->

                            </article><!-- #post-## -->

                        </main><!-- #main -->
                    </div><!-- #primary -->


                </div><!-- .col-full -->
            </div><!-- #content -->

 @include('front.includes.bottom-ads')
@endsection