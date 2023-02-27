<!DOCTYPE html>
<html lang="{{App::getLocale()}}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8" content="{{csrf_token()}}" id='_token'>

        <title>@yield('title')</title>
        <meta name="keywords" content="@yield('seo_meta_tags')">
        <meta name="description" content="@yield('seo_meta_description')">

        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/font-awesome.min.css')}}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/animate.min.css')}}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/font-electro.css')}}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/owl-carousel.css')}}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/colors/yellow.css')}}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/colors/yellow.css')}}" media="all" />

        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,700italic,800,800italic,600italic,400italic,300italic' rel='stylesheet' type='text/css'>

        <link rel="shortcut icon" href="{{asset('assets/images/fav-icon.png')}}">
                <style type="text/css">
            .language-list-item:before {
                content: none !important;
            }
        </style>
    </head>

    <body class=" @yield('body-classes')">
        <div id="page" class="hfeed site">
            <a class="skip-link screen-reader-text" href="#site-navigation">{{__('Skip to navigation')}}</a>
            <a class="skip-link screen-reader-text" href="#content">{{__('Skip to content')}}</a>

            <div class="top-bar">
                <div class="container">
                    <nav>
                        <ul id="menu-top-bar-left" class="nav nav-inline pull-left animate-dropdown flip">
                            <li class="menu-item animate-dropdown"><a title="{{__('Welcome to ' . env('APP_NAME') . ' Marketplace')}}" href="{{url('/shop')}}">{{__('Welcome to ' . env('APP_NAME') . ' Marketplace')}}</a></li>
                        </ul>
                    </nav>

                    <nav>
                        <ul id="menu-top-bar-right" class="nav nav-inline pull-right animate-dropdown flip">
                           <li class="menu-item menu-item-has-children animate-dropdown dropdown">
                                <a  href="javascript:void(0)" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true" aria-expanded="false">
                                <i class="ec ec-language"></i>
                                    {{__('Language')}} {{session()->get('lang')}}
                                </a>
                                <ul role="menu" class="dropdown-menu" style="min-width: 100px;">
                                    <li class="language-list-item menu-item "><a  href="{{URL::current()}}?lang=ar">Arabic</a></li>
                                    <li class="language-list-item menu-item "><a href="{{URL::current()}}?lang=en">English</a></li>
                                </ul>
                            </li>
                            <li class="menu-item animate-dropdown"><a title="Track Your Order" href="{{url('/order-tracking')}}"><i class="ec ec-transport"></i>{{__('Track Your Order')}}</a></li>
                            <li class="menu-item animate-dropdown"><a title="Shop" href="{{url('/shop')}}"><i class="ec ec-shopping-bag"></i>{{__('Shop')}}</a></li>
                            <li class="menu-item animate-dropdown"><a title="My Account" href="{{url('/my-account')}}"><i class="ec ec-user"></i>{{__('My Account')}}</a></li>
                        </ul>
                    </nav>
                </div>
            </div><!-- /.top-bar -->

            <header id="masthead" class="site-header header-v2">
                <div class="container">
                    <div class="row">

                        <!-- ============================================================= Header Logo ============================================================= -->
                        <div class="header-logo">
                            <a href="{{url('/')}}" class="header-logo-link">
                                Logo
                            </a>
                        </div>
                        <!-- ============================================================= Header Logo : End============================================================= -->

                        <div class="primary-nav animate-dropdown">
                            <div class="clearfix">
                                 <button class="navbar-toggler hidden-sm-up pull-right flip" type="button" data-toggle="collapse" data-target="#default-header">
                                        &#9776;
                                 </button>
                            </div>

                            <div class="collapse navbar-toggleable-xs" id="default-header">
                                <nav>
                                    <ul id="menu-main-menu" class="nav nav-inline yamm">
                                      <li class="menu-item"><a href="{{url('/')}}">{{__('Home')}}</a></li>
                                    <li class="menu-item"><a href="{{url('/shop')}}">{{__('Shop')}}</a></li>
                                    <li class="menu-item"><a href="{{url('/blog')}}">{{__('Blog')}}</a></li>
                                    <li class="menu-item"><a href="{{url('/faqs')}}">{{__('Faqs')}}</a></li>
                                    <li class="menu-item"><a href="{{url('/contact_us')}}">{{__('Contact Us')}}</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>

                        <div class="header-support-info">
                            <div class="media">
                                <span class="media-left support-icon media-middle"><i class="ec ec-support"></i></span>
                                <div class="media-body">
                                    <span class="support-number"><strong>{{__('Support')}}</strong> (+000) 00 800 604</span><br/>
                                    <span class="support-email">{{__('Email')}}: info@taeamul.com</span>
                                </div>
                            </div>
                        </div>

                    </div><!-- /.row -->
                </div>
            </header><!-- #masthead -->

            <nav class="navbar navbar-primary navbar-full">
                <div class="container">
                    <ul class="nav navbar-nav departments-menu animate-dropdown">
                        <li class="nav-item dropdown ">

                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="departments-menu-toggle" >{{__('Shop by Department')}}</a>
                            <ul id="menu-vertical-menu" class="dropdown-menu yamm departments-menu-dropdown">
                                
                                    @foreach(App\Category::where('status','!=',0)->where('is_featured','!=',0)->get() as $category)
                                    <li class="yamm-tfw menu-item menu-item-has-children animate-dropdown dropdown">
                                        <a title="{{__(ucwords($category->name))}}" data-hover="dropdown" href="{{url('/shop',$category->slug)}}" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">{{__(ucwords($category->name))}}</a>
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
                                    </li>
                                    @endforeach
                            </ul>
                        </li>
                    </ul>
                    <form class="navbar-search" action="{{route('front.shop',[Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}" method="get" id="searchForm">
                            <label class="sr-only screen-reader-text" for="search">{{__('Search for')}}:</label>
                            <div class="input-group">
                                <input type="text" id="search" value="{{request('search')}}" class="form-control search-field" dir="ltr" name="search" placeholder="Search for products" />
                                <div class="input-group-addon search-categories">
                                    <select id='product_cat' class='postform resizeselect' >
                                        <option disabled selected='selected'>{{__('All Categories')}}</option>
                                        @foreach(App\Category::where('status','!=',0)->get() as $row)
                                        <option class="level-0" value="{{$row->slug}}">{{__(ucwords($row->name))}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-secondary"><i class="ec ec-search"></i></button>
                                </div>
                            </div>
                        </form>

                    <ul id="upperCartUl" class="navbar-mini-cart navbar-nav animate-dropdown nav pull-right flip" >
                            
                       @include('front.ajax.upperCart')
                    </ul>

                    <ul class="navbar-wishlist nav navbar-nav pull-right flip">
                        <li class="nav-item">
                            <a href="{{url('/wishlist')}}" class="nav-link"><i class="ec ec-favorites"></i>
                            <!-- <span style="background-color: #333e48;color:white;padding: 2px;border-radius: 20px">{{Cart::content()->count()}}</span> -->
                        </a>
                        </li>
                    </ul>
                    <ul class="navbar-compare nav navbar-nav pull-right flip">
                        <li class="nav-item">
                            <a href="{{url('/compare')}}" class="nav-link"><i class="ec ec-compare"></i></a>
                        </li>
                    </ul>
                </div>
            </nav>
            @yield('content')
             @include('front.includes.footer')
            <!-- #colophon -->

        </div><!-- #page -->

        <script type="text/javascript" src="{{asset('assets/js/jquery.min.js')}}"></script>
        @include('front.partials.script')
        @yield('jquery')
        <script type="text/javascript">
            jQuery(document).ready(function () {
                jQuery('#newsletterSub').submit(function (e) {
                    jQuery('#signUpNewsLetterBtn').hide();
                    jQuery('#signUpNewsLetterBtn2').show();
                    e.preventDefault();
                    var field =jQuery('#subscribe').val();
                    var url = '{{route("subscribe.coupon")}}';
                    jQuery.ajax({
                        url:url,
                        type:'POST',
                        data:{
                            input:field,
                            _token:jQuery('#_token').attr('content'),
                          },
                          success:function (data) {
                            if (data.success) {
                                toastr.success(data.success,'{{__("Success")}}');
                            }
                            if (data.danger) {
                                toastr.error(data.danger,'{{__("Danger")}}');
                            }
                            if (data.error) {
                                printErrorMsg(data.error)
                            }
                            jQuery('#signUpNewsLetterBtn').show();
                            jQuery('#signUpNewsLetterBtn2').hide();  
                          },
                    });
                })
            })
                    function printErrorMsg (msg) {


            jQuery.each( msg, function( key, value ) {

                jQuery(".errPr").append('<li>'+value+'</li>');

            });

        }
        </script>
        <script type="text/javascript" src="{{asset('assets/js/tether.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/bootstrap.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/bootstrap-hover-dropdown.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/echo.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/wow.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/jquery.easing.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/jquery.waypoints.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/electro.js')}}"></script>
         <a id="scrollUp" href="javascript:void(0)" style="position: fixed; z-index: 1001;display: none;"><i class="fa fa-angle-up"></i></a>
         <script type="text/javascript">
            mybutton = document.getElementById("scrollUp");
            window.onscroll = function() {scrollFunction()};

            function scrollFunction() {
              if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                mybutton.style.display = "block";
              } else {
                mybutton.style.display = "none";
              }
            }
         </script>
    </body>
</html>
