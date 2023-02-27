<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware'=> 'locale'], function(){
	
	Route::post('/upper_cart', 'Front\ViewController@getUpperCart');
	Route::post('/featured_products', 'Front\ViewController@getFeaturedProducts');
	Route::post('/hotSaleTrending_products', 'Front\ViewController@getHotSaleTrendingProducts');
	Route::post('/recentlyAdded_products', 'Front\ViewController@getRecentlyAddedProducts');
	Route::post('/sale_products', 'Front\ViewController@getsaleProducts');
	Route::post('/topRated_products', 'Front\ViewController@getTopRatedProducts');
	Route::post('/bestDeals_products', 'Front\ViewController@getBestDealsProducts');
	Route::post('/bestSellers_products', 'Front\ViewController@getBestSellersProducts');
	Route::post('/comments_view', 'Front\ViewController@comments');
	Route::post('/review_view', 'Front\ViewController@reviews');

	// USER ROUTES
	Route::group(['middleware' => ['verified','auth','check_customer','check_user_status']],function(){
		Route::get('/my-account','User\UserController@index')->name('user.account');
		Route::post('/my-account/update', 'User\UserController@update');
		Route::get('/my-account/logout', 'User\UserController@logout')->name('user.logout');
		Route::post('/my-account/update_email', 'User\UserController@updateEmail')->name('user.email.update');
		Route::post('/my-account/update_pass', 'User\UserController@updatePassword')->name('user.pass.update');
		Route::post('/dashboardData', 'User\UserController@dashboardData');
		Route::post('/editProfileData', 'User\UserController@editProfileData');
		Route::post('/ordersData', 'User\UserController@ordersData');
		Route::post('/orderTrackingData', 'User\UserController@orderTrackingData');
		Route::post('/settingsData', 'User\UserController@settingsData');
		Route::post('/my-account/order/{slug}', 'User\UserController@viewOrderData');
		Route::post('/userMessage', 'User\UserController@messageData');

	});

	Route::post('my-account/order_status_track', 'User\BaseController@orderTrackData')->name('order.status.fetch');



	// Blogs Routes

	Route::get('/blog','Front\ViewController@blog');
	Route::get('/blog/post/{slug}','Front\ViewController@post');
	Route::post('/blog/post/create/{slug}','Front\ActionController@commentStore')->name('post.comment');


	// CART ROUTES
	Route::get('/cart', 'Front\CartController@index');
	Route::post('/cart/add/{slug}', 'Front\CartController@store')->name('card.add');
	Route::post('/cart/add_product/{slug}', 'Front\CartController@productStore');
	Route::post('/cart/update', 'Front\CartController@update');
	Route::get('/cart/remove/{slug}', 'Front\CartController@remove');
	Route::post('/cart_class', 'Front\ViewController@getCartItems');
	Route::post('/cart_discount', 'Front\ViewController@getCartDiscount');

	// WISHLIST ROUTES
	Route::get('/wishlist', 'Front\WishlistController@index');
	Route::post('/wishlist/add/{slug}', 'Front\WishlistController@store')->name('wishlist.add');
	Route::get('/wishlist/remove/{slug}', 'Front\WishlistController@remove');
	Route::post('/compare_class', 'Front\ViewController@getCompareItems');


	// COMPARE ROUTES
	Route::get('/compare', 'Front\CompareController@index');
	Route::post('/compare/add/{slug}', 'Front\CompareController@store')->name('compare.add');
	Route::get('/compare/remove/{slug}', 'Front\CompareController@remove');
	Route::post('/wishlist_class', 'Front\ViewController@getWishlistItems');

	Route::get('/checkout-completed', 'Front\CheckoutController@complete_checkout');

	// USER AUTH ROUTES
	Auth::routes(['verify' => true]);

	// FRONT ROUTES
	Route::get('/checkout', 'Front\ViewController@checkout');
	Route::get('/order-tracking', 'Front\ViewController@order_track')->name('order.track');
	Route::get('/order_success', 'Front\ViewController@order_success');
	Route::get('/shop/{category?}/{subcategory?}/{childcategory?}', 'Front\ViewController@shop')->name('front.shop');
	Route::get('/contact_us', 'Front\ViewController@contact_us');
	Route::get('/faqs', 'Front\ViewController@faqs');
	Route::get('/', 'Front\ViewController@index');
	Route::get('/{slug}', 'Front\ViewController@product');
	Route::get('page/{slug}', 'Front\ViewController@page');
	Route::post('/contactEmail', 'Front\ActionController@contactUs')->name('msg.send');
	Route::post('/msgSend', 'User\BaseController@message')->name('user.msg.send');
	Route::post('/user/msg/send/', 'User\BaseController@msgData')->name('in.msg');
	Route::post('/subscriber_coupon', 'Front\CouponController@couponOnEmail')->name('subscribe.coupon');
	Route::post('/cart_coupon', 'Front\CouponController@coupon')->name('coupon.cart');


	Route::post('product/size/update/{size}/{product}','Front\ActionController@sizeUpdate')->name('product.update.size');
	Route::post('product/default/update/{product}','Front\ActionController@ProductDefaultPrice')->name('product.default.update');
	Route::post('product/wholesale/update/{id}','Front\ActionController@WholeSalePrice')->name('wholesale.price.update');

	Route::post('/order','Front\CheckoutController@store_order')->name('order.store');
	Route::post('/reviewStore/{slug}','Front\ActionController@review_store');

	// VENDOR ROUTES
	Route::group(['prefix'=>'vendor', 'middleware' => ['auth','check_vendor']],function(){
		Route::get('/dashboard','Vendor\VendorController@index')->name('vendor.dashboard');

		Route::post('logout', 'Vendor\VendorController@logout')->name('vendor.logout');

		Route::get('/v-profile','Vendor\VendorController@profile')->name('v-profile');
		 Route::post('v-profile/update','Vendor\VendorController@update')->name('v-profile.update');

		Route::get('/v-settings', 'Vendor\VendorController@settings')->name('v-settings');

		Route::get('/v-settings/shop', 'Vendor\VendorController@shopsettings')->name('v-settings.shop');

		 Route::post('v-settings/update/shop','Vendor\VendorController@updateShop')->name('v-settings.update.shop');

		 Route::post('v-settings/change/password','Vendor\VendorController@changePassword')->name('v-settings.change.password');
		 Route::post('v-settings/change/email','Vendor\VendorController@changeEmail')->name('v-settings.change.email');

		// Vendor Product Routes
		Route::resource('v-products', 'Vendor\ProductController');
		Route::get('/v-product/datatable', 'Vendor\ProductController@datatables')->name('v-product.datatable');
		Route::post('/v-product/{id}/update', 'Vendor\ProductController@update')->name('v-product.update');
		Route::get('/v-product/active/{id}', 'Vendor\ProductController@active')->name('v-product.active');
		Route::get('/v-product/deactive/{id}', 'Vendor\ProductController@deactive')->name('v-product.deactive');
		Route::get('/v-product/{product_id}/{image_id}/delete', 'Vendor\ProductController@deleteProductImage')->name('v-product.image.delete');
		Route::get('/v-get_new_sku/','Vendor\ProductController@generateSku')->name('v-generate.Sku');

		// Vendor Order Routes
		Route::resource('v-orders', 'Vendor\OrderController');
		Route::get('v-orders/invoice/{id}', 'Vendor\OrderController@invoice')->name('v-orders.invoice');
		Route::get('/v-order/datatable', 'Vendor\OrderController@datatables')->name('v-order.datatable');
		Route::get('v-orders/status/{id}', 'Vendor\OrderController@getStatus')->name('v-orders.status');
		Route::post('v-orders/change/status/{id}', 'Vendor\OrderController@changeStatus')->name('v-orders.change_status');

		// Vendor Withdraw Routes
		Route::get('/v-withdraws', 'Vendor\WithdrawController@index')->name('v-withdraws');
		Route::get('/v-withdraw/create', 'Vendor\WithdrawController@create')->name('v-withdraw.create');
		Route::post('/v-withdraw/store', 'Vendor\WithdrawController@store')->name('v-withdraw.store');
		Route::get('/v-withdraws/datatable', 'Vendor\WithdrawController@datatables')->name('v-withdraws.datatable');

	});

	// ADMIN AUTH ROUTES
	Route::get('admin/login','Admin\LoginController@index')->name('admin.login');
	Route::post('admin/do_login','Admin\LoginController@login')->name('admin.do_login');

	Route::get('admin/reset/password','Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.reset.password');
	Route::post('admin/password/email','Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');

	Route::get('admin/password/reset/{token}','Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');

    Route::POST('admin/reset/password', 'Admin\ResetPasswordController@reset');

    // ADMIN ROUTES

	Route::group(['prefix'=>'admin', 'middleware'=>'auth:admin'],function(){

		 Route::get('/dashboard','Admin\AdminController@index')->name('admin.dashboard');
		 Route::post('/logout','Admin\LoginController@logout')->name('admin.logout');

		 Route::get('/admin/profile','Admin\AdminController@profile')->name('admin.profile');
		 Route::post('/admin/profile/update','Admin\AdminController@update')->name('admin.profile.update');
		 Route::get('/admin/settings','Admin\AdminController@settings')->name('admin.settings');
		 Route::post('/admin/settings/change/password','Admin\AdminController@changePassword')->name('admin.settings.change.password');

		// Admin Staff Routes
		Route::resource('staffs','Admin\StaffController');
		Route::get('/staff/datatable', 'Admin\StaffController@datatables')->name('admin.staff.datatable');

		// Admin Roles Route
		Route::resource('roles','Admin\RoleController');
		Route::get('/role/datatable', 'Admin\RoleController@datatables')->name('admin.role.datatable');

	     // Admin Customers Routes
	     Route::get('/customers','Admin\CustomerController@index')->name('admin.customers');
	     Route::get('/customers/{id}/details','Admin\CustomerController@show')->name('admin.customers.show');
	     Route::get('/customers/{id}/edit','Admin\CustomerController@edit')->name('admin.customers.edit');
	     Route::post('/customers/{id}/update','Admin\CustomerController@update')->name('admin.customers.update');
	     Route::delete('/customers/{id}/destroy','Admin\CustomerController@destroy')->name('admin.customers.destroy');
	     Route::get('/customers/{id}/deactive/', 'Admin\CustomerController@block')->name('admin.customers.block');
	     Route::get('/customers/{id}/active/', 'Admin\CustomerController@unblock')->name('admin.customers.unblock');
	     Route::get('/customers/datatable', 'Admin\CustomerController@datatables')->name('admin.customers.datatable');

	     //Admin Vendors Routes
	     Route::get('/vendors','Admin\VendorController@index')->name('admin.vendors');
	     Route::get('/vendors/{id}/details','Admin\VendorController@show')->name('admin.vendors.show');
	     Route::get('/vendors/{id}/edit','Admin\VendorController@edit')->name('admin.vendors.edit');
	     Route::post('/vendors/{id}/update','Admin\VendorController@update')->name('admin.vendors.update');
	     Route::delete('/vendors/{id}/destroy','Admin\VendorController@destroy')->name('admin.vendors.destroy');
	     Route::get('/vendors/{id}/deactive/', 'Admin\VendorController@unverify')->name('admin.vendors.unverify');
	     Route::get('/vendors/{id}/active/', 'Admin\VendorController@verify')->name('admin.vendors.verify');
	     Route::get('/vendors/datatable', 'Admin\VendorController@datatables')->name('admin.vendors.datatable');

	     // Admin Products Routes
	     Route::resource('products', 'Admin\ProductController');
	     Route::post('/product/{id}/update', 'Admin\ProductController@update')->name('admin.product.update');
	     Route::get('/product/{product_id}/{image_id}/delete', 'Admin\ProductController@deleteProductImage')->name('admin.product.image.delete');
	     Route::get('/product/deactiveproducts', 'Admin\ProductController@deactiveproducts')->name('admin.deactiveproducts');
	     Route::get('/product/datatable', 'Admin\ProductController@datatables')->name('admin.products.datatable');
	     Route::get('/product/deactivedatatables', 'Admin\ProductController@deactivedatatables')->name('admin.products.deactivedatatables');
	     Route::get('/product/active/{id}', 'Admin\ProductController@active')->name('admin.product.active');
	     Route::get('/product/deactive/{id}', 'Admin\ProductController@deactive')->name('admin.product.deactive');
	     Route::get('/products/gethighlight/{id}', 'Admin\ProductController@gethighlightProduct')->name('admin.products.gethighlight');
	     Route::post('/products/highlight/{id}', 'Admin\ProductController@highlightProduct')->name('admin.products.highlight');



	     // Admin Categories Routes 
	     Route::resource('categories', 'Admin\CategoryController');
	     Route::get('/category/active/{id}', 'Admin\CategoryController@active')->name('admin.category.active');
	     Route::get('/category/subcategory/{id}', 'Admin\CategoryController@getSubcatOptions')->name('admin.categorysubcategory.options');
	     Route::get('/category/deactive/{id}', 'Admin\CategoryController@deactive')->name('admin.category.deactive');
	     Route::get('/category/datatable','Admin\CategoryController@datatables')->name('admin.categories.datatable');

	     // Admin SubCategories Routes 
	     Route::resource('subcategories', 'Admin\SubCategoryController');
	     Route::get('/subcategory/active/{id}', 'Admin\SubCategoryController@active')->name('admin.subcategory.active');
	     Route::get('/subcategory/ChildOptions/{id}', 'Admin\SubCategoryController@getChildcatOptions')->name('admin.subchildcategory.options');
	     Route::get('/subcategory/deactive/{id}', 'Admin\SubCategoryController@deactive')->name('admin.subcategory.deactive');
	     Route::get('/subcategory/datatable','Admin\SubCategoryController@datatables')->name('admin.subcategories.datatable');

	     // Admin ChildCategories Routes 
	     Route::resource('childcategories', 'Admin\ChildCategoryController');
	     Route::get('/childcategory/active/{id}', 'Admin\ChildCategoryController@active')->name('admin.childcategory.active');
	     Route::get('/childcategory/deactive/{id}', 'Admin\ChildCategoryController@deactive')->name('admin.childcategory.deactive');
	     Route::get('/subcategory/options/{id}', 'Admin\ChildCategoryController@subcategoryOptions')->name('admin.subcategory.options');
	     Route::get('/childcategory/attributes/{id}', 'Admin\ChildCategoryController@attributes')->name('admin.childcategory.attributes');
	     Route::get('/childcategory/datatable','Admin\ChildCategoryController@datatables')->name('admin.childcategories.datatable');

	     // Admin Attributes Routes 
	     Route::get('attributes/{id}/create', 'Admin\AttributeController@create')->name('admin.attributes.create');
	     Route::post('attributes/{id}/store', 'Admin\AttributeController@store')->name('admin.attributes.store');
	     Route::get('attributes/{id}/manage', 'Admin\AttributeController@manage')->name('admin.attributes.manage');
	     Route::get('attributes/{id}/edit', 'Admin\AttributeController@edit')->name('admin.attributes.edit');
	     Route::post('attributes/{id}/update', 'Admin\AttributeController@update')->name('admin.attributes.update');
	     Route::DELETE('attributes/{id}/delete', 'Admin\AttributeController@destroy')->name('admin.attributes.delete');


	     // Admin Orders Routes
	     Route::get('/orders/{status}','Admin\OrderController@index')->name('admin.orders');
	     Route::get('/orders/{id}/details/','Admin\OrderController@show')->name('admin.orders.show');
	     Route::get('/orders/{id}/get_status/','Admin\OrderController@getStatus')->name('admin.orders.get_status');
	     Route::post('/orders/{id}/change_status/','Admin\OrderController@changeStatus')->name('admin.orders.change_status');
	     Route::get('/orders/{id}/invoice/','Admin\OrderController@invoice')->name('admin.orders.invoice');
	     Route::get('/orders/{id}/send_invoice/','Admin\OrderController@send_invoice')->name('admin.orders.send_invoice');
	     Route::get('/orders/datatable/{status}','Admin\OrderController@datatables')->name('admin.orders.datatable');

	     // Admin Vendor Payment Settings Routes
	     Route::get('/payment_settings','Admin\PaymentSettingController@index')->name('admin.payment.settings');
	     Route::post('/payment_settings/update','Admin\PaymentSettingController@update')->name('admin.payment.settings.update');

	     // Admin Vendor Payment Withdraw Routes
	     Route::get('/payment_withdraws','Admin\PaymentWithdrawController@index')->name('admin.vendor.payment.withdraws');
	     Route::get('/payment_withdraws/{id}/details','Admin\PaymentWithdrawController@show')->name('admin.vendor.payment.withdraw.detail.show');
	     Route::get('/payment_withdraws/{id}/{status}/change_status','Admin\PaymentWithdrawController@status')->name('admin.vendor.payment.withdraw.status');
	     Route::get('/payment_withdraws_datatables','Admin\PaymentWithdrawController@datatables')->name('admin.vendor.payment.datatable');

	     // Admin Pages Routes
	     Route::resource('pages','Admin\PageController');
	     Route::get('page/datatable','Admin\PageController@datatables')->name('admin.page.datatable');
	     Route::resource('faqs','Admin\FaqController');
	     Route::get('faq/datatable','Admin\FaqController@datatables')->name('admin.faq.datatable');
	     Route::get('/contact_page_details','Admin\ContactDetailController@index')->name('admin.contact_details');
	     Route::post('/contact_page_details/update','Admin\ContactDetailController@update')->name('admin.contact_details.update');

	     // Admin Banner Routes
	     Route::resource('banners','Admin\BannerController');
	     Route::get('banner/datatable','Admin\BannerController@datatables')->name('admin.banner.datatable');

		    // Blog Routes
		Route::get('/create_post/','Admin\BlogController@create')->name('admin.create.post');
		Route::get('/create_category/','Admin\BlogController@createCategory')->name('admin.create.category');

		Route::get('/blog_posts/','Admin\BlogController@fetchPost')->name('admin.posts');
		Route::get('/blog_categories/','Admin\BlogController@fetchCategory')->name('admin.categories');
		Route::DELETE('/blog_categories/destroy/{id}','Admin\BlogController@destroyCat')->name('admin.categories.destroy');
		Route::get('/blog_comments/','Admin\BlogController@fetchComment')->name('admin.comments');

		Route::get('/blog_categories/datatable', 'Admin\BlogController@datatableCat')->name('admin.blog.cat.datatable');
		Route::get('/blog_posts/datatable', 'Admin\BlogController@datatablePost')->name('admin.blog.post.datatable');
		Route::get('/blog_comments/datatable', 'Admin\BlogController@datatableComment')->name('admin.blog.comment.datatable');
		Route::post('/store_post/','Admin\BlogController@store')->name('admin.post.store');
		Route::post('/addCategory/','Admin\BlogController@addCategory')->name('admin.category.add');
		Route::delete('/delCategory/','Admin\BlogController@delCategory')->name('admin.category.del');

		// Message Routes
		Route::get('/admin/msg/get/{id}','Admin\MessageController@msgFetch')->name('admin.msg.ajax');
		Route::get('/messages','Admin\MessageController@index')->name('msg.show');
		Route::post('/adminMsgSend', 'Admin\MessageController@message')->name('msg.admin');

		// Review Routes
		Route::get('/productReview','Admin\ReviewController@index')->name('product.review');
		Route::get('/reviewViewTable', 'Admin\ReviewController@reviewDatatable')->name('admin.review.datatable');
		Route::get('/reviewEdit/{id}', 'Admin\ReviewController@edit')->name('review.edit');
		Route::post('/reviewUpdate/{id}', 'Admin\ReviewController@update')->name('review.Update');
		Route::DELETE('/reviewDelete/{id}', 'Admin\ReviewController@destroy')->name('review.destroy');

		// Coupons Routes
		Route::get('/coupons/fetch','Admin\CouponController@index')->name('coupon.index');
		Route::get('/coupons/create','Admin\CouponController@create')->name('coupon.create');
		Route::post('/coupons/store','Admin\CouponController@store')->name('coupon.store');
		Route::get('/coupons/edit/{id}','Admin\CouponController@edit')->name('coupon.edit');
		Route::post('/coupons/update/{id}','Admin\CouponController@update')->name('coupon.update');
		Route::get('/coupons/active/{id}','Admin\CouponController@active')->name('admin.coupon.active');
		Route::get('/coupons/deactive/{id}','Admin\CouponController@deactive')->name('admin.coupon.deactive');
		Route::DELETE('/coupons/dlt/{id}','Admin\CouponController@destroy')->name('coupon.destroy');

		Route::get('/couponTable', 'Admin\CouponController@couponDatatable')->name('admin.coupon.datatable');

		// Subscriber Routes
		Route::resource('subscriber', 'Admin\SubscriberController');
		Route::get('subscriber_dtable','Admin\SubscriberController@datatable')->name('subscriber.datatable');

		// Admin Seo Routes
	     Route::get('seo/datatable','Admin\SeoController@datatables')->name('admin.seo.datatable');
	     Route::get('/seo','Admin\SeoController@index')->name('admin.seo');
	     Route::get('/seo/{id}','Admin\SeoController@edit')->name('admin.seo.edit');
	     Route::post('/seo/update/{id}','Admin\SeoController@update')->name('admin.seo.update');

	    Route::resource('wholesaleunits', 'Admin\WholeSaleUnitController');
	    Route::get('/get_new_sku/','Admin\ProductController@generateSku')->name('admin.generate.Sku');


		Route::get('/clear-cache', function() {
		    Artisan::call('cache:clear');
		    Artisan::call('route:clear');
		    Artisan::call('view:clear');
		    // Artisan::call('key:generate');
		    Artisan::call('optimize');
		    Artisan::call('clear-compiled');
		    Artisan::call('config:clear');
		    Artisan::call('optimize:clear');
		    return redirect()->back()->with('success','Cache Files Cleared');
		});
		Route::get('/sync-keys', function() {

		    $this->translation->saveMissingTranslations();

		    return redirect()->back()->with('success','Missing Keys Synchronised Successfully!');
		})->name('admin.sync_translated_keys');
	});

});

// Locale Route End

Route::get('/clear-cache', function() {
    Artisan::call('optimize:clear');
    return redirect()->back()->with('success','Cache Files Cleared');
});