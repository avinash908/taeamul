@extends('layouts.front.master')
@include('front.includes.blog_seo')
@section('body-classes','blog blog-list right-sidebar')

@section('content')

 <div id="content" class="site-content" tabindex="-1">
            	<div class="container">

            		<nav class="woocommerce-breadcrumb">
            			<a href="{{url('/')}}">{{__('Home')}}</a>
            			<span class="delimiter"><i class="fa fa-angle-right"></i></span>{{__('Blog')}}
            		</nav>

            		<div id="primary" class="content-area">
            			<main id="main" class="site-main">
            				@include('front.includes.article')
            				<nav class="navigation pagination">
                                <h2 class="screen-reader-text">{{__('Posts navigation')}}</h2>
                                <div class="nav-links " style="text-align: center;">
                                    {{$posts->links()}}
                                </div>
                            </nav>


            			</main>
            		</div><!-- /#primary -->

            		<div id="sidebar" class="sidebar-blog" role="complementary">
                        <aside id="search-2" class="widget widget_search">
                            <form role="search" method="get" class="search-form" action="{{url('/blog')}}">
                            	<label>
                            		<span class="screen-reader-text">{{__('Search for:')}}</span>
                            		<input type="search" class="search-field" placeholder="Search &hellip;" value="" name="s" />
                            	</label>
                            	<input type="submit" class="search-submit" value="Search" />
                            </form>
                        </aside>
                                    
                                    <aside class="widget widget_categories">
                            <h3 class="widget-title">{{__('Categories')}}</h3>
                            <ul>
                                @foreach($cat as $rec)
                                <li class="cat-item"><a href="{{url('/blog'.'?category='.$rec->slug)}}" >{{__($rec->title)}}</a></li>
                                @endforeach
                        	</ul>
                        </aside>
                    </div>
                </div><!-- /.container -->
            </div><!-- /.site-content -->


@endsection