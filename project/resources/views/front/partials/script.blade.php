<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/toastr.css')}}">
<script type="text/javascript" src="{{ asset('assets/js/toastr.js')}}"></script>
<script type="text/javascript">
	jQuery(document).on('click','.add2wishlist',function () {
		var curent = jQuery(this).parent('.real-wishlist-icon');
		var parent = curent.parent('.wishlist-loader');
    var loader = parent.children('.loader_cart');
		jQuery.ajax({
			url:jQuery(this).attr('data-url'),
			type:'post',
            data: { _token:jQuery('#_token').attr('content') },
            beforeSend:function () {
            	curent.hide();
    			loader.show();
            },
            success:function(data){
  			toastr.success(data.success, '{{__("Success")}}');
			upperCart();
		
            },
            complete:function (argument) {
            	curent.show();
    			loader.hide();
            }
		});
	});
	jQuery(document).on('click','.compare_AI',function () {
		var curent = jQuery(this).parent('.real-compare-icon');
		var parent = curent.parent('.compare-loader');
    var loader = parent.children('.loader_cart');



			jQuery.ajax({
			url:jQuery(this).attr('data-url'),
			type:'post',
            data: { _token:jQuery('#_token').attr('content') },
            beforeSend:function () {
            	curent.hide();
    			loader.show();
            },
            success:function(data){
  			if (data.success) {
  				toastr.success(data.success, '{{__("Success")}}');
  			}
  			if (data.danger) {
	  			toastr.error(data.danger, '{{__("Danger")}}');
  			}
			upperCart();
		
            },
            complete:function (argument) {
            	curent.show();
    			loader.hide();
            }
		});
	});
	jQuery(document).on('click','.add2cart',function () {
		var curent = jQuery(this).parent('.real-cart-icon');
		var parent = curent.parent('.cart-loader');
		var loader = parent.children('.loader_cart');
		jQuery.ajax({
			url:jQuery(this).attr('data-url'),
			type:'post',
            data: { _token:jQuery('#_token').attr('content') },
            beforeSend:function () {
            	curent.hide();
    			loader.show();
            },
            success:function(data){
  			toastr.success(data.success, '{{__("Success")}}');
			upperCart();
            },
            complete:function (argument) {
            	curent.show();
    			loader.hide();
            }
		});
	});
	function upperCart() {
			jQuery.ajax({
				url:"{{url('/upper_cart')}}",
				type:'post',
                data: { _token:jQuery('#_token').attr('content') },
                success:function (data) {
                	jQuery('#upperCartUl').empty();
                   jQuery('#upperCartUl').html(data.html);
                }
			})
	}
			upperCart();
			function cartItems(argument) {
			jQuery.ajax( {
               url: '<?=url("/cart_class")?>',
               method:'POST',
               data: { _token:jQuery('#_token').attr('content') },
               success:function (data) {
                   jQuery('.class_cart').empty();
                   jQuery('.class_cart').html(data.html);
               }
            });
			}
			function wishlistItems(argument) {
			jQuery.ajax( {
               url: '<?=url("/wishlist_class")?>',
               method:'POST',
               data: { _token:jQuery('#_token').attr('content') },
               success:function (data) {
                   jQuery('.class_wishlist').empty();
                   jQuery('.class_wishlist').html(data.html);
               }
            });
			}
			function compareItem() {
			jQuery.ajax( {
               url: '<?=url("/compare_class")?>',
               method:'POST',
               data: { _token:jQuery('#_token').attr('content') },
               success:function (data) {
                   jQuery('.compare_class').empty();
                   jQuery('.compare_class').html(data.html);
               }
            });
			}
	jQuery(document).on('click','.removeItem',function () {
				jQuery.ajax({
					url:jQuery(this).attr('data-cart-remove'),
					type:'get',
	                success:function (data) {
	  				toastr.success(data.success, '{{__("Success")}}');
	                   upperCart();
	                   cartItems();
	                   wishlistItems();
	                }
				})
			});
	jQuery(document).on('click','.remove-compare',function () {
        jQuery.ajax({
            url:jQuery(this).attr('data-url'),
            type:'get',
            success:function (data) {
            toastr.success(data.success, '{{__("Success")}}');
			 compareItem();

            }
        });
    })

</script>
@include('front.partials.success')
@include('front.partials.danger')
<script type="text/javascript">
  
function hotSaleTrending_products() {
    jQuery.ajax( {
       url: '<?=url("/hotSaleTrending_products")?>',
       method:'POST',
       data: { _token:jQuery('#_token').attr('content') },
       success:function (data) {
           jQuery('#hotSaleTrending').empty()
           jQuery('#hotSaleTrending').html(data.html)
       }
    });
}
hotSaleTrending_products();
</script>
<script type="text/javascript">
jQuery(document).on('change','#product_cat',function(){
  var val = jQuery(this).val();
  if(val != "" && val != null){
    jQuery('#searchForm').attr('action', '<?=url("/shop")?>/' + val);
  }
});
jQuery(document).on('click','#scrollUp',function() {
  jQuery("html, body").animate({ scrollTop: 0 }, 2000);
});
</script>