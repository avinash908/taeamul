@extends('layouts.front.app')
@section('title',env('APP_Name') . ' - Login' )
         @section('content')

            <div id="content" class="site-content" tabindex="-1">
                <div class="container">

                    <nav class="woocommerce-breadcrumb" ><a href="{{url('/')}}">{{__('Home')}}</a>
                    <span class="delimiter"><i class="fa fa-angle-right"></i></span>{{__('My Account')}}
                    <span class="delimiter"><i class="fa fa-angle-right"></i></span>{{__('Login')}}
                </nav>

                    <div id="primary" class="content-area">
                        <main id="main" class="site-main">
                            <article id="post-8" class="hentry">

                                <div class="entry-content">
                                    @if ($errors->any())
                                        <ul class="alert alert-danger">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    @if(session()->has('msg'))
                                        <div class="alert alert-danger">
                                            {{session()->get('msg')}}
                                        </div>
                                    @endif
                                    <div class="woocommerce">
                                        <div class="customer-login-form">
                                            <span class="or-text">or</span>

                                            <div class="col2-set" id="customer_login">

                                                <div class="col-1">


                                                    <h2>{{ __('Login') }}</h2>

                                                    <form action="{{ route('login') }}" method="post" class="login t_login_form">
                                                        @csrf
                                                        <p class="before-login-text">{{__('Welcome back! Sign in to your account')}}</p>
                                                        <p class="form-row form-row-wide">
                                                            <label for="email" class="required">{{ __('E-Mail Address') }}</label>
                                                             <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" >
                                                             @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </p>

                                                        <p class="form-row form-row-wide">
                                                            <label for="password" class="">{{ __('Password') }}</label>
                                                           <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                                            @error('password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </p>
                                                        <p class="form-row">
                                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                            <label class="form-check-label" for="remember">
                                                                {{ __('Remember Me') }}
                                                            </label>
                                                        </p>

                                                        <p class="lost_password">
                                                             <button type="submit" class="btn btn-primary t_login_reg_btn">
                                                                {{ __('Login') }}
                                                            </button>

                                                            @if (Route::has('password.request'))
                                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                                    {{ __('Forgot Your Password?') }}
                                                                </a>
                                                            @endif</p>

                                                    </form>


                                                </div><!-- .col-1 -->

                                                <div class="col-2">

                                                    <h2>{{__('Register')}}</h2>

                                                    <form action="{{ route('register') }}" method="post"  class="register t_login_form" enctype="multipart/form-data">
                                                        @csrf
                                                        <p class="before-register-text">{{__('Create your very own account')}}</p>

                                                        <p class="form-row form-row-wide">
                                                           <label for="name" class="">{{ __('Name') }}*</label>
                                                            <input id="name" type="text" class="input-text form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Your Good Name...">

                                                            @error('name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </p>
                                                        <p class="form-row form-row-wide">
                                                            <label for="email" class="">{{ __('E-Mail Address') }}*</label>
                                                            <input id="email" type="email" class="form-control @error('r-email') is-invalid @enderror" name="r-email" value="{{ old('r-email') }}" required autocomplete="email" placeholder="jhondoe@example.com">

                                                            @error('r-email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </p>
                                                        <p class="form-row form-row-wide">
                                                           <label for="password" class="">{{ __('Password') }}*</label>
                                                            <input type="password" class="form-control @error('r-password') is-invalid @enderror" name="r-password"  value="{{ old('r-password') }}" placeholder="********" required autocomplete="new-password">

                                                            @error('r-password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </p>
                                                           <p class="form-row form-row-wide">
                                                          <label for="password-confirm" class="">{{ __('Confirm Password') }}*</label>
                                                            <input id="password-confirm" type="password" class="form-control" name="r-password_confirmation"  value="{{ old('r-password_confirmation') }}" required placeholder="********" autocomplete="new-password">

                                                            @error('rpassword')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </p>
                                                        <p class="form-row">

                                                            <label>{{ __('City')}}*</label>
                                                            <input type="text" placeholder="City Name" class="form-control" name="city" placeholder="City Name" value="{{ old('city') }}"  required="">
                                                            @error('city')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </p>
                                                        <p class="form-row">

                                                            <label>{{ __('Address')}}*</label>
                                                            <input type="text" placeholder="full address" class="form-control" name="address" placeholder="" value="{{ old('address') }}" required="">
                                                            @error('address')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </p>

                                                        <p class="form-row">
                                                            <label style="display: block;">{{ __('Phone Number')}}*</label>
                                                             
                                                             <select name="vendor_number_code" style="width: 20%;border: 1px solid;padding: 0.857em 1.214em;background-color: transparent; color: #818181;line-height: 1.286em;outline: none; border: 0; -webkit-appearance: none; border-radius: 1.571em 0em 0em 1.571em;box-sizing: border-box;border-width: 1px;border-style: solid;border-color: #dddddd;" ><option data-countrycode="SA" value="966" selected="selected">+966</option>
                                                             </select>
                                                                <input type="text" style="width: 79%; border-radius: 0em 1.571em 1.571em 0em;"  name="phone" placeholder="00 000 0000" minlength="9" max="10" value="{{ old('phone') }}" required="">
                                                            @error('phone')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </p>
                                                        <p class="form-row">
                                                            <input type="radio" class="input_vendor" name="is_vendor" <?= (old('is_vendor') == 0) ? 'checked="checked"' : '' ?> value="0"  >
                                                            <label>{{ __('I am A Customer')}}</label>
                                                                
                                                        </p>
                                                        <p class="form-row">
                                                            <input type="radio" class="input_vendor" value="1" <?= (old('is_vendor') == 1) ? 'checked="checked"' : '' ?> name="is_vendor">
                                                            <label>{{ __('I am A Vendor')}}</label>

                                                        <div id="vendor-input" style="display: <?= (old('is_vendor') == 1) ? 'block' : 'none' ?>;">
                                                            <div class="content">
                                                                            
                                                                           <p class="col-lg-6">
                                                                                <label>{{ __('Shop Name')}}*</label>

                                                                                <input type="text" class="form-control vendor-inputs" name="shop_name" value="{{ old('shop_name') }}" placeholder="Shop Name..." >
                                                                                @error('shop_name')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                            </p>
                                                                           <p class="col-lg-6">
                                                                                <label>{{ __('Owner Name')}}*</label>

                                                                                <input type="text" class="form-control vendor-inputs" name="owner_name" value="{{ old('owner_name') }}" placeholder="Shop Owner Name" >
                                                                                 @error('owner_name')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                            </p>
                                        
                                                                    <p class="form-row">
                                                                        <label>{{ __('Shop Email')}}*</label>
                                                                        <input type="text" class="form-control vendor-inputs" name="shop_email" value="{{ old('shop_email') }}" placeholder="Shop Email" >
                                                                        @error('shop_email')
                                                                                                        <span class="invalid-feedback" role="alert">
                                                                                                            <strong>{{ $message }}</strong>
                                                                                                        </span>
                                                                                                    @enderror
                                                                    </p>
                                                                     <p class="form-row">
                                                                                                    <label style="display: block;">{{ __('Shop Number')}}*</label>
                                                                                                     
                                                                                                     <select name="shop_number_code" style="width: 20%;border: 1px solid;padding: 0.857em 1.214em;background-color: transparent; color: #818181;line-height: 1.286em;outline: none; border: 0; -webkit-appearance: none; border-radius: 1.571em 0em 0em 1.571em;box-sizing: border-box;border-width: 1px;border-style: solid;border-color: #dddddd;" >
                                                                                                    <option data-countrycode="SA" value="966" selected="selected">+966</option>
                                                                                                     </select>
                                                                                                        <input type="text" style="width: 79%; border-radius: 0em 1.571em 1.571em 0em;"  value="{{ old('shop_number') }}" name="shop_number" placeholder="00 000 0000" minlength="9" max="10">
                                                                                                    @error('shop_number')
                                                                                                        <span class="invalid-feedback" role="alert">
                                                                                                            <strong>{{ $message }}</strong>
                                                                                                        </span>
                                                                                                    @enderror
                                                                                                </p>
                                                                    <p class="form-row">
                                                                     <label>{{ __('National Id Number')}}*</label>
                                                                        <input type="text" class="form-control vendor-inputs" name="national_id" value="{{ old('national_id') }}" placeholder="National Id Number">
                                                                        @error('national_id')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </p>
                                                                    <p class="form-row">
                                                                        <label>{{ __('Upload National Id Copy')}}*</label>
                                                                        <div class="custom-file">
                                                                        <input type="file" class="form-control custom-file-input form-control vendor-inputs" style="
                                                                              padding: 0.857em 1.214em;
                                                            background-color: transparent;
                                                            color: #818181;
                                                            line-height: 1.286em;
                                                            outline: none;
                                                            border: 0;
                                                            border-top-color: currentcolor;
                                                            border-top-style: none;
                                                            border-top-width: 0px;
                                                            border-right-color: currentcolor;
                                                            border-right-style: none;
                                                            border-right-width: 0px;
                                                            border-bottom-color: currentcolor;
                                                            border-bottom-style: none;
                                                            border-bottom-width: 0px;
                                                            border-left-color: currentcolor;
                                                            border-left-style: none;
                                                            border-left-width: 0px;
                                                            -webkit-appearance: none;
                                                            border-radius: 1.571em;
                                                            box-sizing: border-box;
                                                            border-width: 1px;
                                                            border-style: solid;
                                                            border-color: #dddddd;

                                                                        "  name="national_copy" id="national_copy" >
                                                                        @error('national_copy')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </p>
                                                                      </div>
                                                                    
                                                                    </p>
                                                                    <p class="form-row">
                                                                        <label>{{ __('Commercial Registration Number')}}*</label>

                                                                        <input type="text" class="form-control vendor-inputs" name="comercial_reg_number"  value="{{ old('comercial_reg_number') }}"  placeholder="Comercial Register Number">
                                                                         @error('comercial_reg_number')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror

                                                                    </p>
                                                                   <p class="form-row">
                                                                        <label>{{ __('Upload Commercial  Registration Copy')}}*</label>
                                                                        <div class="custom-file">
                                                                        <input type="file" class="form-control custom-file-input form-control vendor-inputs" style="
                                                                              padding: 0.857em 1.214em;
                                                                background-color: transparent;
                                                                color: #818181;
                                                                line-height: 1.286em;
                                                                outline: none;
                                                                border: 0;
                                                                border-top-color: currentcolor;
                                                                border-top-style: none;
                                                                border-top-width: 0px;
                                                                border-right-color: currentcolor;
                                                                border-right-style: none;
                                                                border-right-width: 0px;
                                                                border-bottom-color: currentcolor;
                                                                border-bottom-style: none;
                                                                border-bottom-width: 0px;
                                                                border-left-color: currentcolor;
                                                                border-left-style: none;
                                                                border-left-width: 0px;
                                                                -webkit-appearance: none;
                                                                border-radius: 1.571em;
                                                                box-sizing: border-box;
                                                                border-width: 1px;
                                                                border-style: solid;
                                                                border-color: #dddddd;

                                                                        "  name="comercial_reg_copy" id="comercial_reg_copy">
                                                                        @error('comercial_reg_copy')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                      </div>
                                                                    
                                                                    </p>
                                                                    <p class="col-lg-6">
                                                                        <label>{{ __('District')}}</label>
                                                                        <input type="text"  value="{{ old('shop_district') }}"  class="form-control vendor-inputs" name="shop_district" placeholder="District" >
                                                                    </p>
                                                                    <p class="col-lg-6">

                                                                     <label>{{ __('Shop City')}}*</label>

                                                                        <input type="text" class="form-control vendor-inputs" name="shop_city"  value="{{ old('shop_city') }}" placeholder="City" >
                                                                    </p>
                                                                    <p class="form-row">

                                                                        <label>{{ __('Street Name')}}</label>

                                                                        <input type="text" class="form-control vendor-inputs" name="shop_street"  value="{{ old('shop_street') }}"  placeholder="Street Name" >
                                                                    </p>
                                                                    <p class="form-row">

                                                                        <label>{{ __('Shop Full Address')}}*</label>

                                                                        <input type="text" class="form-control vendor-inputs" name="shop_address"  value="{{ old('shop_address') }}" placeholder="" >
                                                                    </p>
                                                                    
                                                                    <p class="col-lg-6">

                                                                        <label>{{ __('Mailbox')}}</label>

                                                                        <input type="text" class="form-control vendor-inputs" name="shop_mail_box"  value="{{ old('shop_mail_box') }}" placeholder="MailBox" >
                                                                        <i class="icofont-inbox"></i>
                                                                    </p>
                                                                    <p class="col-lg-6">

                                                                            <label>{{ __('Postal Code')}}</label>

                                                                        <input type="text" class="form-control vendor-inputs" name="shop_postal_code"  value="{{ old('shop_postal_code') }}" placeholder="Postal Code" >
                                                                    </p>

                                                                   <p class="form-row">

                                                                    <label>{{ __('Shop Activity')}}    </label>
                                                                        <textarea style="border: 1px solid black" class="form-control vendor-inputs" name="shop_activity" >{{ old('shop_activity') }}</textarea>    
                                                                    </p>

                                                                        <br>
                                                            </div>
                                                        </div>
                                                        <p class="form-row">
                                                            <label>Complete Captcha*</label>
                                                            @captcha 
                                                            <input type="text" id="captcha" name="captcha" class="form-control" autocomplete="off" placeholder="Enter Code" required>
                                                            @error('captcha')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </p>
                                                        <p class="text" style="color: red">{{('Vendor registration details verified in 24 hours for correct data')}}</p>

                                                        <p class="form-row">
                                                            <input type="submit" class="button t_login_reg_btn" name="register" value="Register" />
                                                        </p>

                                                    </form>

                                                </div><!-- .col-2 -->

                                            </div><!-- .col2-set -->

                                        </div><!-- /.customer-login-form -->
                                    </div><!-- .woocommerce -->
                                </div><!-- .entry-content -->

                            </article><!-- #post-## -->

                        </main><!-- #main -->
                    </div><!-- #primary -->

                </div><!-- .col-full -->
            </div><!-- #content -->

         @endsection


@section('jquery')
<script type="text/javascript">
    var $jq = jQuery.noConflict();
    $jq(document).ready(function () {
        $jq(document).on('click','.input_vendor',function () {
            if ($jq(this).attr('value') == 0) {
                $jq('.vendor-inputs').removeAttr('required');
                $jq('#vendor-input').hide();
            }else{
                // $jq('#vendor-input').fadeIn();
                $jq('.vendor-inputs').attr('required','required');
                $jq('#vendor-input').fadeIn();
            }
        });

        if($jq("input[name='is_vendor']:checked").val() == 1){
            $jq('.vendor-inputs').attr('required','required');
        }else{
            $jq('.vendor-inputs').removeAttr('required');
        }

        $jq(document).on('submit','.t_login_form',function(){
            $jq('.t_login_reg_btn').attr('disabled','disabled');
        });
    });
</script>
@endsection