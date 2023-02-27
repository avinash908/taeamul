@extends('layouts.front.app')
@include('front.includes.seo')
@section('content')


    <div class="row">
        <div class="col-xs-12 col-lg-3">
            <nav>
                <ul class="list-group vertical-menu yamm make-absolute">
                    <li class="list-group-item"><span><i class="fa fa-list-ul"></i> {{__('All Departments')}}</span></li>

                    @foreach(App\Category::where('status','!=',0)->where('is_featured','!=',0)->get() as $category)
                    <li class="yamm-tfw menu-item menu-item-has-children animate-dropdown dropdown">
                        <a title="{{__(ucwords($category->name))}}" data-hover="dropdown" href="{{url('/shop',$category->slug)}}" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">{{__(ucwords($category->name))}}</a>
                        @if($category->subs->count() > 0)
                            <ul role="menu" class=" dropdown-menu">
                                <li class="menu-item animate-dropdown menu-item-object-static_block">
                                    <div class="yamm-content">
                                        <div class="row">
                                        @foreach($category->subs as $sub)
                                            <div class="col-sm-6">
                                                <div class="vc_column-inner ">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element ">
                                                            <div class="wpb_wrapper">
                                                                <ul>
                                                                    <li class="nav-title"><a href="{{url('/shop',['slug1' => $sub->category->slug, 'slug2' => $sub->slug])}}">{{__(ucwords($sub->name))}}</a></li>

                                                                    @foreach($sub->childs as $child)
                                                                    <li><a href="{{url('/shop',['slug1' => $child->subcategory->category->slug, 'slug2' => $child->subcategory->slug, 'slug3' => $child->slug])}}">{{__(ucwords($child->name))}}</a></li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </nav>
        </div>
         <script type="text/javascript">
                jQuery('.nav_hide').hide();
            </script>
        <div class="col-xs-12 col-lg-9">
            <nav>
                <ul id="menu-secondary-nav" class="secondary-nav">
                    <li class="menu-item"><a href="{{url('/')}}">{{__('Home')}}</a></li>
                    <li class="menu-item"><a href="{{url('/shop')}}">{{__('Shop')}}</a></li>
                    <li class="menu-item"><a href="{{url('/blog')}}">{{__('Blog')}}</a></li>
                    <li class="menu-item"><a href="{{url('/faqs')}}">{{__('Faqs')}}</a></li>
                    <li class="menu-item"><a href="{{url('/contact_us')}}">{{__('Contact Us')}}</a></li>
                    @foreach(App\Page::where('type','=',null)->orderBy('id','asc')->take(2)->get() as $top_pg)
                    <li class="pull-right menu-item"><a href="{{url('/page',$top_pg->slug)}}" style="font-weight: bold;margin-right: 1em;">{{__($top_pg->title)}}</a></li>
                    @endforeach
                </ul>
            </nav>
        </div>
    </div>
</div>
            </header><!-- #masthead -->

            <div id="content" class="site-content" tabindex="-1">
                <div class="container ">
                    <div id="primary" class="content-area">
                        <main id="main" class="site-main">
                            <div class="home-v1-slider" >
                                <!-- ========================================== SECTION – HERO : END========================================= -->

                                <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">

                                    @foreach(App\Banner::where('position','=','top_silder')->latest()->take(6)->get() as $slider)
                                    <div class="item" style="background-image: url(<?=asset($slider->image)?>);">
                                        <div class="container ">
                                            <div class="row">
                                                <div class="col-md-offset-6 col-md-4">
                                                    <div class="caption vertical-center text-left">
                                                        <div class="hero-1 fadeInDown-1" style="color: white;mix-blend-mode: exclusion;">
                                                            {{__($slider->title)}}
                                                        </div>

                                                        <div class="hero-subtitle fadeInDown-2" >
                                                            {!! __( $slider->content ) !!}
                                                        </div>
                                                        <div class="hero-v2-price fadeInDown-3" style="color: white;mix-blend-mode: exclusion;">
                                                            {{__('offer')}} <br><span>{{__($slider->offer)}}</span>
                                                        </div>
                                                        <div class="hero-action-btn fadeInDown-4">
                                                            <a href="{{$slider->link}}" class="big le-button ">{{__('Start Buying')}}</a>
                                                        </div>
                                                    </div><!-- /.caption -->
                                                </div>
                                            </div>
                                        </div><!-- /.container  -->
                                    </div><!-- /.item -->
                                    @endforeach

                                </div><!-- /.owl-carousel -->

                                <!-- ========================================= SECTION – HERO : END ========================================= -->

                            </div><!-- /.home-v1-slider -->

                            <div class="home-v1-ads-block animate-in-view fadeIn animated" data-animation="fadeIn">
                                <div class="ads-block row">
                                     @foreach(App\Banner::where('position','=','top_widgets')->latest()->take(3)->get() as $add)
                                    <div class="ad col-xs-12 col-sm-4">
                                        <div class="media">
                                            <div class="media-left media-middle">
                                                <img data-echo="<?=asset($add->image)?>" src="<?=asset($add->image)?>" alt="<?=asset($add->title)?>">
                                            </div>
                                            <div class="media-body media-middle">
                                                <div class="ad-text">
                                                    <strong>{{__($add->title)}}</strong>
                                                    {!! __($add->content) !!}
                                                </div>
                                                <div class="ad-action">
                                                    <a href="{{$add->link}}">{{__($add->offer)}}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="home-v1-deals-and-tabs deals-and-tabs row animate-in-view fadeIn animated" data-animation="fadeIn">
                             


                                <div class="tabs-block col-lg-12">
                                    <div class="products-carousel-tabs">
                                        <ul class="nav nav-inline">
                                            <li class="nav-item"><a class="nav-link active" href="#tab-products-1" data-toggle="tab">{{__('Featured')}}</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#tab-products-2" data-toggle="tab">{{__('On Sale')}}</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#tab-products-3" data-toggle="tab">{{__('Top Rated')}}</a></li>
                                        </ul>

                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab-products-1" role="tabpanel">
                                                <div class="woocommerce columns-3">

                                                    <ul id="featured" class="products columns-3">
                                                     @foreach(App\Product::where('status',1)->where('is_featured',1)->take(6)->get() as $row)
                                                     <li class="product  col-4" style="padding: 10rem 12rem">
                                                        <img src="{{asset('assets/images/ajax-loader.gif')}}" class="img-fluid">
                                                    </li>
                                                     @endforeach
                                                        
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="tab-pane" id="tab-products-2" role="tabpanel">
                                                <div class="woocommerce columns-3">
                                                    <ul id="sale" class="products columns-3">
                                                        @foreach(App\Product::where('status',1)->where('is_sale',1)->take(6)->get() as $row)
                                                                 <li class="product  col-3" style="padding: 10rem 10rem">
                                                                    <img src="{{asset('assets/images/ajax-loader.gif')}}" class="img-fluid">
                                                                </li>
                                                         @endforeach
                                                        
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="tab-pane" id="tab-products-3" role="tabpanel">
                                                <div class="woocommerce columns-3">

                                                    <ul id="topRated" class="products columns-3">
                                                         @foreach(App\Product::where('status',1)->where('is_topRated',1)->take(6)->get() as $row)
                                                                 <li class="product  col-3" style="padding: 10rem 10rem">
                                                                    <img src="{{asset('assets/images/ajax-loader.gif')}}" class="img-fluid">
                                                                </li>
                                                         @endforeach
                                                    </ul>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.tabs-block -->
                            </div><!-- /.deals-and-tabs -->

                            <!-- ============================================================= 2-1-2 Product Grid ============================================================= -->
                            <section class="section-product-cards-carousel animate-in-view fadeIn animated" data-animation="fadeIn">
                                <header>
                                    <h2 class="h1">{{__('Best Deals')}}</h2>

                                    
                                </header><!-- /header-->


                                <div id="homev3-products-cards-carousel">
                                    <div class="woocommerce home-v3 columns-2 product-cards-carousel owl-carousel owl-loaded owl-drag">

                                        
                                        

                                    <div class="owl-stage-outer">
                                        <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 2340px;">
                                            <div class="owl-item active last-active" style="width: 1170px;">
                                                <ul id="bestDeals" class="products columns-2">
                                                    
                                                </ul>
                                            
                                       
                                </div><!-- /#homev3-products-cards-carousel-->

                            </section>
                            <!-- ============================================================= 2-1-2 Product Grid : End============================================================= -->

                            <section class="section-product-cards-carousel animate-in-view fadeIn animated" data-animation="fadeIn">

                                <header>

                                    <h2 class="h1">{{__('Best Sellers')}}</h2>

                                </header>

                                <div id="home-v1-product-cards-careousel">
                                    <div class="woocommerce columns-3 home-v1-product-cards-carousel product-cards-carousel owl-carousel">

                                        <ul id="bestSeller" class="products columns-3">
                                           
                                            
                                        </ul>
                                        
                                    </div>
                                </div><!-- #home-v1-product-cards-careousel -->

                            </section>

                            <div class="home-v1-banner-block animate-in-view fadeIn animated" data-animation="fadeIn">
                                @foreach(App\Banner::where('position','=','middle')->latest()->take(1)->get() as $middle)
                                <div class="home-v1-fullbanner-ad fullbanner-ad" style="margin-bottom: 70px">
                                    <a href="{{$middle->link}}">
                                        <img src="{{asset($middle->image)}}" data-echo="{{asset($middle->image)}}" class="img-responsive" alt="">
                                    </a>
                                </div>
                                @endforeach
                            </div><!-- /.home-v1-banner-block -->

                                <div class="home-v1-deals-and-tabs deals-and-tabs row animate-in-view fadeIn animated" data-animation="fadeIn">
                           

                                <div class="tabs-block col-lg-12">
                                    <div class="products-carousel-tabs">
                                        <ul class="nav nav-inline">
                                            <li class="nav-item"><a class="nav-link active" href="#tab-products-1" data-toggle="tab">{{__('Recently Added')}}</a></li>
                                        </ul>

                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab-products-1" role="tabpanel">
                                                <div class="woocommerce columns-3">

                                                    <ul id="recentlyAdded" class="products row">
                                                     @foreach(App\Product::where('status','!=',0)->where('is_new','!=',0)->take(6)->get() as $row)
                                                     <li class="product  col-3" style="padding: 10rem 12rem">
                                                        <img src="{{asset('assets/images/ajax-loader.gif')}}" class="img-fluid">
                                                    </li>
                                                     @endforeach
                                                        
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.tabs-block -->
                            </div><!-- /.deals-and-tabs -->

                           
                        </main><!-- #main -->
                    </div><!-- #primary -->

                </div><!-- .container  -->
            </div><!-- #content -->
            @include('front.includes.bottom-ads')
            @endsection


@section('jquery')
<script type="text/javascript">
    jQuery(document).ready(function(){
        function featured_products() {
            jQuery.ajax( {
               url: '<?=url("/featured_products")?>',
               method:'POST',
               data: { _token:jQuery('#_token').attr('content') },
               success:function (data) {
                   jQuery('#featured').empty()
                   jQuery('#featured').html(data.html)
               }
            });
        }
        featured_products();
         function sale_products() {
            jQuery.ajax( {
               url: '<?=url("/sale_products")?>',
               method:'POST',
               data: { _token:jQuery('#_token').attr('content') },
               success:function (data) {
                   jQuery('#sale').empty();
                   jQuery('#sale').html(data.html);
               }
            });
        }
        sale_products();
           function topRated_products() {
            jQuery.ajax( {
               url: '<?=url("/topRated_products")?>',
               method:'POST',
               data: { _token:jQuery('#_token').attr('content') },
               success:function (data) {
                   jQuery('#topRated').empty();
                   jQuery('#topRated').html(data.html);
               }
            });
        }
        topRated_products();
        function bestDeals_products() {
            jQuery.ajax( {
               url: '<?=url("/bestDeals_products")?>',
               method:'POST',
               data: { _token:jQuery('#_token').attr('content') },
               success:function (data) {
                   jQuery('#bestDeals').empty();
                   jQuery('#bestDeals').html(data.html);
               }
            });
        }
        bestDeals_products();
        function bestSellers_products() {
            jQuery.ajax( {
               url: '<?=url("/bestSellers_products")?>',
               method:'POST',
               data: { _token:jQuery('#_token').attr('content') },
               success:function (data) {
                   jQuery('#bestSeller').empty();
                   jQuery('#bestSeller').html(data.html);
               }
            });
        }
        bestSellers_products();
         function recentlyAdded_products() {
            jQuery.ajax( {
               url: '<?=url("/recentlyAdded_products")?>',
               method:'POST',
               data: { _token:jQuery('#_token').attr('content') },
               success:function (data) {
                   jQuery('#recentlyAdded').empty();
                   jQuery('#recentlyAdded').html(data.html);
               }
            });
        }
        recentlyAdded_products();        

    })
        </script>
@endsection
