@extends('layouts.front.app')
@section('title',env('APP_Name') . ' - Checkout' )
@section('content')

            <div id="content" class="site-content" tabindex="-1">
                <div class="container">

                    <nav class="woocommerce-breadcrumb"><a href="{{url('/')}}">{{__('Home')}}</a><span class="delimiter"><i class="fa fa-angle-right"></i></span>{{__('Checkout')}}</nav>

                    <div id="primary" class="content-area">
                        <main id="main" class="site-main">
                            <article class="page type-page status-publish hentry">
                                <header class="entry-header"><h1 itemprop="name" class="entry-title">{{__('Checkout')}}</h1></header><!-- .entry-header -->

                                <form enctype="multipart/form-data" action="{{route('order.store')}}" class="checkout woocommerce-checkout" method="post" name="checkout">
                                    @csrf
                                    <div id="customer_details" class="col2-set">
                                        <div class="col-1">
                                            @if(Auth::check())
                                                @include('front.includes.login-checkout')
                                            @else
                                                @include('front.includes.guest-checkout')
                                            @endif
                                        </div>

                                        <div class="col-2">
                                            <h3>{{__('Shipping Details')}}</h3>
                                            <div class="woocommerce-shipping-fields">
                                                <h3 id="ship-to-different-address">
                                                    <label class="checkbox" for="ship-to-different-address-checkbox">{{__('Ship to a different address?')}}</label>
                                                    <input type="checkbox" value="1" name="ship_to_different_address" class="input-checkbox" id="ship-to-different-address-checkbox" >
                                                </h3>
                                            <div id="shipping-inputsfields" style="display: none;">

                                                <p id="billing_first_name_field" class="form-row form-row form-row-second validate-required"><label class="" for="billing_first_name">{{__('Full Name')}} <abbr title="required" class="required">*</abbr></label><input type="text"  placeholder="" id="billing_first_name" value="{{old('shipping_name')}}" name="shipping_name" class="input-text shipping-inputs"></p>
                                                    @error('shipping_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ __($message) }}</strong>
                                                    </span>
                                                        @enderror
                                                <div class="clear"></div>

                                                <p id="billing_email_field" class="form-row form-row form-row-first validate-required validate-email"><label class="" for="billing_email">{{__('Email Address')}} <abbr title="required" class="required">*</abbr></label><input type="email"  placeholder="" id="billing_email" value="{{old('shipping_email')}}" name="shipping_email" class="input-text shipping-inputs" ></p>
                                                @error('shipping_email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ __($message) }}</strong>
                                                    </span>
                                                        @enderror
                                                <p id="billing_phone_field" class="form-row form-row form-row-last validate-required validate-phone"><label class="" for="billing_phone">Phone <abbr title="required" class="required">*</abbr></label><input type="tel"  placeholder="" id="billing_phone" name="shipping_phone" value="{{old('shipping_phone')}}" class="input-text shipping-inputs" ></p>
                                                 @error('shipping_phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ __($message) }}</strong>
                                                    </span>
                                                        @enderror
                                                <div class="clear"></div>


                                                <p id="billing_address_1_field" class="form-row form-row form-row-wide address-field validate-required"><label class="" for="billing_address_1">{{__('Address')}} <abbr title="required" class="required">*</abbr></label><input type="text"  placeholder="Street address" id="billing_address_1" name="shipping_address"  value="{{old('shipping_address')}}"  class="input-text shipping-inputs" ></p>
                                                 @error('shipping_address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ __($message) }}</strong>
                                                    </span>
                                                        @enderror

                                                <p id="billing_city_field" class="form-row form-row form-row-wide address-field validate-required" data-o_class="form-row form-row form-row-wide address-field validate-required"><label class="" for="billing_city">{{__('City')}} <abbr title="required" class="required">*</abbr></label><input type="text"  placeholder="" id="billing_city" name="shipping_city" class="input-text shipping-inputs" value="{{old('shipping_city')}}"  ></p>
                                                @error('shipping_city')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ __($message) }}</strong>
                                                    </span>
                                                        @enderror
                                                <p id="billing_state_field" class="form-row form-row form-row-first validate-required validate-email"><label class="" for="billing_state">{{__('State')}}<abbr title="required" class="required">*</abbr></label><input type="text"  placeholder="" id="billing_state" name="shipping_state" class="input-text shipping-inputs" value="{{old('shipping_state')}}" ></p>
                                                @error('shipping_state')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ __($message) }}</strong>
                                                    </span>
                                                        @enderror
                                                <p id="billing_postcode_field" class="form-row form-row form-row-last address-field validate-postcode validate-required" data-o_class="form-row form-row form-row-last address-field validate-required validate-postcode"><label class="" for="billing_postcode">{{__('Postcode / ZIP')}} <abbr title="required" class="required">*</abbr></label><input type="text"  placeholder="" id="billing_postcode" name="shipping_zip" class="input-text shipping-inputs" value="{{old('shipping_zip')}}" ></p>
                                                 @error('shipping_zip')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ __($message) }}</strong>
                                                    </span>
                                                        @enderror
                                                <div class="clear"></div>

                                            </div>    
                                                <p id="order_comments_field" class="form-row form-row notes"><label class="" for="order_comments">{{__('Order Notes')}}</label><textarea cols="5" rows="2" placeholder="Notes about your order, e.g. special notes for delivery." id="order_comments" class="input-text " name="order_note"></textarea></p>
                                            </div>
                                        </div>
                                    </div>

                                    <h3 id="order_review_heading">{{__('Your order')}}</h3>

                                    <div class="woocommerce-checkout-review-order" id="order_review">
                                        <table class="shop_table woocommerce-checkout-review-order-table">
                                            <thead>
                                                <tr>
                                                    <th class="product-name">{{__('Product')}}</th>
                                                    <th class="product-total">{{__('Total')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach(Cart::content() as $item)
                                                <tr class="cart_item">
                                                    <td class="product-name">
                                                        {{__($item->name)}}&nbsp;
                                                        <strong class="product-quantity">× {{$item->qty}}</strong>
                                                    </td>
                                                    <td class="product-total">
                                                        <span class="amount">Sr {{$item->total}}</span>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>

                                                <tr class="cart-subtotal">
                                                    <th>{{__('Subtotal')}}</th>
                                                    <td><span class="amount">Sr {{Cart::subtotal()}}</span></td>
                                                </tr>

                                               @if(Session::has('couponTotal'))
                                                    <tr class="cart-subtotal">
                                                        <th>{{__('Coupon Discount')}}</th>
                                                        <td data-title="Subtotal"><span class="amount">Sr. {{Session::get('couponTotal')}}</span></td>
                                                    </tr>
                                                    @endif
                                                    <tr class="order-total">
                                                        <th>{{__('Total')}}</th>
                                                        <td data-title="Total" id="refAG"><strong><span class="amount">Sr. 
                                                            <?php
                                                            if (Session::has('couponTotal')) {
                                                                 $c = round(Cart::total()) - Session::get('couponTotal');
                                                                 echo number_format($c,2);
                                                            }else{
                                                               echo Cart::total();
                                                            }
                                                            ?>
                                                    </span></strong> </td>
                                                    </tr>
                                            </tfoot>
                                        </table>

                                        <div class="woocommerce-checkout-payment" id="payment">
                                            <ul class="wc_payment_methods payment_methods methods">
                                                <li class="wc_payment_method payment_method_cod">
                                                    <input type="radio" data-order_button_text="" value="cod" name="payment_method" class="input-radio" id="payment_method_cod" checked required>

                                                    <label for="payment_method_cod">{{__('Cash on Delivery')}}</label>
                                                    <div style="display:none;" class="payment_box payment_method_cod">
                                                        <p>{{__('Pay with cash upon delivery')}}.</p>
                                                    </div>
                                                     @error('payment_method')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ __($message) }}</strong>
                                                    </span>
                                                        @enderror
                                                </li>
                                            </ul>
                                            <div class="form-row place-order">

                                                <p class="form-row terms wc-terms-and-conditions">
                                                    <input type="checkbox" id="terms" class="input-checkbox" name="terms-and-conditions" value="1" required>
                                                    <label class="checkbox" for="terms">{{__('I’ve read and accept the')}} <a target="_blank" href="{{url('/terms-and-conditions')}}">{{__('terms')}} &amp; {{__('conditions')}}</a> <span class="required">*</span></label>
                                                </p>
                                                @error('terms-and-conditions')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ __($message) }}</strong>
                                                    </span>
                                                        @enderror
                                                <input type="submit" data-value="Place order" value="Place order" class="button alt">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </article>
                        </main><!-- #main -->
                    </div><!-- #primary -->
                </div><!-- .container -->
            </div><!-- #content -->

     @include('front.includes.bottom-ads')
           
@endsection
@section('jquery')
<script type="text/javascript">
var $jq = jQuery.noConflict();

    $jq(document).ready(function () {

        $jq(document).on('change','#ship-to-different-address-checkbox',function () {
            if (this.checked) {
                $jq('#shipping-inputsfields').fadeIn();
                $jq('.shipping-inputs').attr('required','required');
            }else{
                $jq('#shipping-inputsfields').hide();
                $jq('.shipping-inputs').removeAttr('required');
            }
        });
        $jq(document).on('change','#createaccount',function () {
            if (this.checked) {
                $jq('#password-inputsfields').fadeIn();
                $jq('.password-inputs').attr('required','required');
            }else{
                $jq('#password-inputsfields').hide();
                $jq('.password-inputs').removeAttr('required');
            }
        })
    });
</script>
@endsection