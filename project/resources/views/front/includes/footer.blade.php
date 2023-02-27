<footer id="colophon" class="site-footer">
                <div class="footer-widgets">
                    <div id="hotSaleTrending" class="container">
                        
                    </div>
                </div>

                <div class="footer-newsletter">
                    <div class="container">
                        <div class="row">
                    @if($var = App\Coupon::orderBy('id','DESC')->where('status',1)->first())
                        @if(($var->used != $var->times) && ($var->used < $var->times))
                            <div class="col-xs-12 col-sm-7">
                                <h5 class="newsletter-title">{{__('Sign up to Newsletter')}}</h5>
                                <span class="newsletter-marketing-text">...{{__('and receive')}} <strong>
                                            Sr. {{$var->price}}
                                            {{__('coupon for first shopping')}}</strong></span>
                                    </div>
                                    <div class="col-xs-12 col-sm-5">
                                        <div>
                                            <ul style="font-weight: bold;color:red" class="errPr list-unstyled">
                                            </ul>
                                            </div>
                                        <form id="newsletterSub" action="javascript:void(0)" method="post">
                                            <div class="input-group">
                                                <input type="text" id="subscribe" class="form-control" name="newsletter" required placeholder="Enter your email address">
                                                <span class="input-group-btn">
                                                    <button style="border-top-right-radius: 40px;border-bottom-right-radius: 40px" id="signUpNewsLetterBtn" class="btn btn-secondary" type="submit">{{__('Sign Up')}}</button>
                                                    <a href="javascript:void(0)" disabled style="display: none;" id="signUpNewsLetterBtn2" class="btn btn-light">{{__('Wait...')}}</a>
                                                </span>
                                            </div>
                                            
                                        </form>
                                    </div>
                            @else
                            <h5 class="newsletter-title">Coupon Codes Expired</h5> 
                        @endif
                    @endif
                        </div>
                    </div>
                </div>


                <div class="footer-bottom-widgets">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-7 col-md-push-5">
                                <div class="columns">
                                    <aside id="nav_menu-2" class="widget clearfix widget_nav_menu">
                                        <div class="body">
                                            <h4 class="widget-title">{{__('Find It Fast')}}</h4>
                                            <div class="menu-footer-menu-1-container">
                                                <ul id="menu-footer-menu-1" class="menu">
                                                    @foreach(App\Category::where('status','!=',0)->where('is_featured','!=',0)->take(6)->get() as $row)
                                                    <li class="menu-item"><a href="{{url('/shop',$row->slug)}}">{{__($row->name)}}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </aside>
                                </div><!-- /.columns -->

                                 
                                 <div class="columns">
                                    <aside id="nav_menu-3" class="widget clearfix widget_nav_menu">
                                        <div class="body">
                                            <h4 class="widget-title">{{__('Customer Care')}}</h4>
                                            <div class="menu-footer-menu-2-container">
                                                <ul id="menu-footer-menu-2" class="menu">
                                                    <li class="menu-item"><a href="{{url('/login')}}">{{__('My Account')}}</a></li>
                                                    <li class="menu-item"><a href="{{url('/order-tracking')}}">{{__('Track your Order')}}</a></li>
                                                    <li class="menu-item"><a href="{{url('/wishlist')}}">{{__('Wishlist')}}</a></li>
                                                    <li class="menu-item"><a href="{{url('/compare')}}">{{__('Compare')}}</a></li>
                                                    <li class="menu-item"><a href="{{url('/contact_us')}}">{{__('Contact Us')}}</a></li>
                                                    <li class="menu-item"><a href="{{url('/faqs')}}">{{__('FAQS')}}</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </aside>
                                </div><!-- /.columns -->
                                <div class="columns">
                                     <aside id="nav_menu-3" class="widget clearfix widget_nav_menu">
                                        <div class="body">
                                            <h4 class="widget-title">{{__('More Pages')}}</h4>
                                            <div class="menu-footer-menu-3-container">
                                                <ul id="menu-footer-menu-3" class="menu">
                                                    @foreach(App\Page::where('type','=',null)->take(6)->get() as $pg)
                                                    <li class="menu-item"><a href="{{url('/page',$pg->slug)}}">{{__($pg->title)}}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </aside>
                                </div>  

                            </div><!-- /.col -->
                            @php
                                $f_contact_detail = App\ContactDetail::findOrFail(1);
                            @endphp
                            <div class="footer-contact col-xs-12 col-sm-12 col-md-5 col-md-pull-7">
                                <div class="footer-logo">
                                    Logo
                                </div><!-- /.footer-contact -->

                                <div class="footer-call-us">
                                    <div class="media">
                                        <span class="media-left call-us-icon media-middle"><i class="ec ec-support"></i></span>
                                        <div class="media-body">
                                            <span class="call-us-text">{{__('Got Questions ? Call us 24/7!')}}</span>
                                            <span class="call-us-number">{{$f_contact_detail->phone}}</span>
                                        </div>
                                    </div>
                                </div><!-- /.footer-call-us -->


                                <div class="footer-address">
                                    <strong class="footer-address-title">{{__('Contact Info')}}</strong>
                                    <address>{{__($f_contact_detail->address)}}</address>
                                    <address> {{__('Email')}}: <a href="mailto:{{$f_contact_detail->email}}">{{$f_contact_detail->email}}</a></address>
                                </div><!-- /.footer-address -->

                                <div class="footer-social-icons">
                                    <ul class="social-icons list-unstyled">
                                        <li><a class="fa fa-facebook" target="_blank" href="{{$f_contact_detail->facebook}}"></a></li>
                                        <li><a class="fa fa-twitter" target="_blank" href="{{$f_contact_detail->twitter}}"></a></li>
                                        <li><a class="fa fa-pinterest" target="_blank" href="{{$f_contact_detail->pinterest}}"></a></li>
                                        <li><a class="fa fa-google-plus" target="_blank" href="mailto:{{$f_contact_detail->gmail}}"></a></li>
                                        <li><a class="fa fa-tumblr" target="_blank" href="{{$f_contact_detail->tumblr}}"></a></li>
                                        <li><a class="fa fa-instagram" target="_blank" href="{{$f_contact_detail->instagram}}"></a></li>
                                        <li><a class="fa fa-youtube" target="_blank" href="{{$f_contact_detail->youtube}}"></a></li>
                                        <li><a class="fa fa-whatsapp" target="_blank" href="https://wa.me/{{$f_contact_detail->whatsapp}}"></a></li>
                                        </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="copyright-bar">
                    <div class="container">
                        <div class="pull-left flip copyright">&copy; <a href="{{url('/')}}">{{__(env('APP_NAME'))}}</a> - {{__('All Rights Reserved')}}</div>
                    </div><!-- /.container -->
                </div><!-- /.copyright-bar -->
            </footer>