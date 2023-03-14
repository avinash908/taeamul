<!DOCTYPE html>
<html lang="{{App::getLocale()}}">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta charset="utf-8" content="{{csrf_token()}}" id='_token'>
  
        <title>@yield('title')</title>
        <meta name="keywords" content="@yield('seo_meta_tags')">
        <meta name="description" content="@yield('seo_meta_description')">
        @yield('header')
        <link rel="stylesheet" type="text/css" href="{{url('assets/css/my.css')}}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{url('assets/css/bootstrap.min.css')}}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{url('assets/css/font-awesome.min.css')}}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{url('assets/css/animate.min.css')}}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{url('assets/css/font-electro.css')}}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{url('assets/css/owl-carousel.css')}}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{url('assets/css/style.css')}}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{url('assets/css/colors/yellow.css')}}" media="all" />


        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,700italic,800,800italic,600italic,400italic,300italic' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="{{url('assets/js/jquery.min.js')}}"></script>

        <link rel="shortcut icon" href="{{url('assets/images/fav-icon.png')}}">
        <style type="text/css">
            .language-list-item:before {
                content: none !important;
            }
        </style>
</head>
<body class="page home page-template-default left-sidebar">
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
                                    {{__('Language')}}
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

            <header id="masthead" class="site-header header-v1">
                <div class="container">
                    <div class="row">

                        <!-- ============================================================= Header Logo ============================================================= -->
                        <div class="header-logo">
                            <a href="{{url('/')}}" class="header-logo-link">
                                <img src="{{asset('assets/images/logo.png')}}" style="width:40%" alt="">
                            </a>
                        </div>
                        <!-- ============================================================= Header Logo : End============================================================= -->

                        <form class="navbar-search" action="{{url('/shop')}}" method="get" id="searchForm">
                            <label class="sr-only screen-reader-text" for="search">{{__('Search for')}}:</label>
                            <div class="input-group">
                                <input type="text" id="search" class="form-control search-field" dir="ltr" name="search" placeholder="Search for products" />
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
                                <a href="{{url('/wishlist')}}" class="nav-link"><i class="ec ec-favorites"></i></a>
                            </li>
                        </ul>
                        <ul class="navbar-compare nav navbar-nav pull-right flip">
                            <li class="nav-item">
                                <a href="{{url('/compare')}}" class="nav-link"><i class="ec ec-compare"></i></a>
                            </li>
                        </ul>

                    </div><!-- /.row -->
                    </div><!-- /.row -->

                        <div class="nav_hide col-xs-12 col-lg-12" style="display: flex;justify-content: center;align-items: center;">
                            <nav>
                            <ul id="menu-secondary-nav" class="secondary-nav">
                                <li class=" menu-item"><a href="{{url('/')}}">{{__('Home')}}</a></li>
                                <li class="menu-item"><a href="{{url('/shop')}}">{{__('Shop')}}</a></li>
                                <li class="menu-item"><a href="{{url('/blog')}}">{{__('Blog')}}</a></li>
                                <li class="menu-item"><a href="{{url('/faqs')}}">{{__('Faqs')}}</a></li>
                                <li class="menu-item"><a href="{{url('/contact_us')}}">{{__('Contact Us')}}</a></li>
                            </ul>
                        </nav>
                        </div>
      <!-- partial -->
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
        <a id="scrollUp" href="javascript:void(0)" style="position: fixed; z-index: 1001; display: none;"><i class="fa fa-angle-up"></i></a>
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
