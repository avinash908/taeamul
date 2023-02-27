@extends('layouts.front.app')
@section('title',env('APP_Name') . ' - Cart' )
@section('content')
    <div id="content" class="site-content" tabindex="-1">
    	<div class="container">

    		<nav class="woocommerce-breadcrumb"><a href="{{url('/')}}">{{__('Home')}}</a><span class="delimiter"><i class="fa fa-angle-right"></i></span>{{__('Cart')}}</nav>

    		<div id="primary" class="content-area">
    			<main id="main" class="site-main">
    				<article class="page type-page status-publish hentry">
    					<header class="entry-header"><h1 itemprop="name" class="entry-title">{{__('Cart')}}</h1></header><!-- .entry-header -->

    					<form id="updateCart" class="RFS" action="{{url('/cart/update')}}" method="post">
                            @csrf
                            <table class="shop_table shop_table_responsive cart">
                                <thead>
                                    <tr>
                                        <th class="product-remove">&nbsp;</th>
                                        <th class="product-thumbnail">&nbsp;</th>
                                        <th class="product-name">{{__('Product')}}</th>
                                        <th class="product-price">{{__('Price')}}</th>
                                        <th class="product-quantity">{{__('Quantity')}}</th>
                                        <th class="product-quantity">{{__('Details')}}</th>
                                        <th class="product-subtotal">{{__('Total')}}</th>
                                    </tr>
                                </thead>
                                <tbody class='class_cart'>
                                        
                                   @include('front.ajax.cart')

                                    </tbody>
                                </table>
                            </form>
                             <div class="coupon">

            <label for="coupon_code">{{__('Coupon')}}:</label>
        <form method="POST" class="row" id="couponCart" action="javascript:void(0)">
            <input type="hidden" value="{{csrf_token()}}" class="token">
           <div class="input-group col-lg-5">

                <input type="text" id="coupon_code" class="form-control" name="newsletter" required="" placeholder="Enter Coupon Code">
             
                <span class="input-group-btn">
                    <button style="border-top-right-radius: 40px;border-bottom-right-radius: 40px" id="signUpNewsLetterBtn" class="btn btn-secondary" type="submit">Apply Coupon</button>
                </span>
            </div>
            </form>

            </div>
        					<div id="cartCollaterals" class="cart-collaterals">
                                @include('front.ajax.cartDiscount')

                            </div>

    				</article>
    			</main><!-- #main -->
    		</div><!-- #primary -->
    	</div><!-- .container -->
    </div><!-- #content -->
     @include('front.includes.bottom-ads')
    
@endsection
          

    
@section('jquery')
<script type="text/javascript">
jQuery(document).ready(function () {
    jQuery('#updateCart').submit(function (e) {
        e.preventDefault();
        jQuery.ajax({
            url:jQuery(this).attr('action'),
            type:'post',
            data:jQuery(this).serialize(),
            success:function (data) {
            toastr.success(data.success, '{{__("Success")}}');

                cartItems();
            },
            error:function (data) {
            toastr.error('{{__("Cart Cannot be updated")}}.', '{{__("Error")}}');
            },
        });
    })
    jQuery('#couponCart').submit(function (e) {
        e.preventDefault();
        var url = "{{route('coupon.cart')}}";
        jQuery.ajax({
            url:url,
            type:'post',
            data:{
                coupon:jQuery('#coupon_code').val(),
                _token:jQuery('.token').val(),
            },
            success:function (data) {
               if (data.success) {
                toastr.success(data.success, '{{__("Success")}}');
                cartDiscount();
               }
                if (data.danger) {
                toastr.info(data.danger, '{{__("Info")}}');
               }
            },
        });
    })
     function cartDiscount() {
            jQuery.ajax( {
               url: '<?=url("/cart_discount")?>',
               method:'POST',
               data: { _token:jQuery('#_token').attr('content') },
               success:function (data) {
                   jQuery('#cartCollaterals').empty();
                   jQuery('#cartCollaterals').html(data.html);
               }
            });
        }
});
</script>
@endsection
