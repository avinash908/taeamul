@extends('layouts.front.app')
@section('title',env('APP_Name') . ' - Wishlist' )
@section('content')
         
            <div tabindex="-1" class="site-content" id="content">
                <div class="container">

                    <nav class="woocommerce-breadcrumb"><a href="{{url('/')}}">{{__('Home')}}</a><span class="delimiter"><i class="fa fa-angle-right"></i></span>{{__('Wishlist')}}</nav>
                    <div class="content-area" id="primary">
                        <main class="site-main" id="main">
                            <article class="page type-page status-publish hentry">
                                <div itemprop="mainContentOfPage" class="entry-content">
                                    <div id="yith-wcwl-messages"></div>
                                    <form class="woocommerce" method="post" id="yith-wcwl-form">

                                        <input type="hidden" value="68bc4ab99c" name="yith_wcwl_form_nonce" id="yith_wcwl_form_nonce"><input type="hidden" value="/electro/wishlist/" name="_wp_http_referer">
                                        <!-- TITLE -->
                                        <div class="wishlist-title ">
                                            <h2>{{__('My Wishlist')}}</h2>
                                        </div>

                                        <!-- WISHLIST TABLE -->
                                        <table data-token="" data-id="" data-page="1" data-per-page="5" data-pagination="no" class="shop_table cart wishlist_table">

                                            <thead>
                                                <tr>

                                                    <th class="product-remove"></th>

                                                    <th class="product-thumbnail"></th>

                                                    <th class="product-name">
                                                        <span class="nobr">{{__('Product Name')}}</span>
                                                    </th>

                                                    <th class="product-price">
                                                        <span class="nobr">{{__('Unit Price')}}</span>
                                                    </th>
                                                    <th class="product-stock-stauts">
                                                        <span class="nobr">{{__('Stock Status')}}</span>
                                                    </th>

                                                    <th class="product-add-to-cart">{{__('Add To Cart')}}</th>

                                                </tr>
                                            </thead>

                                            <tbody class="class_wishlist">
                                            	@include('Front.ajax.wishlist')
                                                
                                                
                                            </tbody>

                                            <tfoot>
                                                <tr>
                                                    <td colspan="6"></td>
                                                </tr>
                                            </tfoot>

                                        </table>

                                        <input type="hidden" value="85fe311a9d" name="yith_wcwl_edit_wishlist" id="yith_wcwl_edit_wishlist"><input type="hidden" value="/electro/wishlist/" name="_wp_http_referer">

                                    </form>

                                </div><!-- .entry-content -->

                            </article><!-- #post-## -->

                        </main><!-- #main -->
                    </div><!-- #primary -->
                </div><!-- .col-full -->
            </div>

 @include('front.includes.bottom-ads')
                

@endsection
@section('toast')
@include('Front.partials.script')
@endsection