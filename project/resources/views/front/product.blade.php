@extends('layouts.front.master')
@include('front.includes.seo')
@section('body-classes','single-product full-width')

@section('content')
<style type="text/css">
    .colorSectionMargin{
        margin: 0px 10px;
    }
    .colorSectionSelect{
        border:3px solid #7b64ff;

    }
    .sizeBorderOne{
        border:1px solid black;
    }
    .sizeBorderTwo{
        border: 3px solid #7b64ff;

    }
</style>

            <div id="content" class="site-content" tabindex="-1">
                <div class="container">

                    <nav class="woocommerce-breadcrumb">
                        <a href="{{url('/')}}">{{__('Home')}}</a>
                        <span class="delimiter"><i class="fa fa-angle-right"></i>
                        </span>{{__('Product')}} <span class="delimiter"><i class="fa fa-angle-right"></i>
                        </span> {{__($product->name)}}
                    </nav><!-- /.woocommerce-breadcrumb -->
                  <div id="primary" class="content-area">
                        <main id="main" class="site-main">

                            <div class="product">

                                <div class="single-product-wrapper">
                                    <div class="product-images-wrapper">
                                        @if($product->condition)
                                        <span class="onsale">
                                            {{__(ucfirst($product->condition))}}
                                        </span>
                                        @endif
                                        <div class="images electro-gallery">
                                            <div class="thumbnails-single owl-carousel">
                                                <a href="{{url('/'.$product->slug)}}" class="zoom" title="" data-rel="prettyPhoto[product-gallery]">
                                                    <img src="{{url('/').'/'.$product->thumbnail}}" data-echo="{{url('/').'/'.$product->thumbnail}}" class="wp-post-image" alt="">
                                                </a>
                                                @foreach($product->images as $img)
                                                <a href="{{url('/'.$product->slug)}}" class="zoom" title="" data-rel="prettyPhoto[product-gallery]">
                                                    <img src="{{url('/').$img->url}}" data-echo="{{url('/').$img->url}}" class="wp-post-image" alt="">
                                                </a>
                                                 @endforeach
                                             
                                            </div><!-- .thumbnails-single -->

                                            <div class="thumbnails-all columns-5 owl-carousel">
                                                <a href="{{url('/'.$product->slug)}}" class="first" title="">
                                                    <img src="{{url('/').'/'.$product->thumbnail}}" data-echo="{{url('/').'/'.$product->thumbnail}}" class="wp-post-image" alt="">
                                                </a>
                                                @foreach($product->images as $img)
                                                <a href="{{url('/'.$product->slug)}}" class="" title=""><img src="{{url('/').$img->url}}" data-echo="{{url('/').$img->url}}" class="wp-post-image" alt=""></a>
                                                @endforeach

                                               
                                            </div><!-- .thumbnails-all -->
                                        </div><!-- .electro-gallery -->
                                    </div><!-- /.product-images-wrapper -->

                                    <div class="summary entry-summary">

                                         @include('front.includes.product_top_cat',['row'=>$product])

                                        <h1 itemprop="name" class="product_title entry-title">{{__(ucwords($product->name))}}</h1>

                                        <div class="woocommerce-product-rating">
                                            <!-- <div class="star-rating" title="Rated 4.33 out of 5">
                                                <span style="width:86.6%">
                                                    <strong itemprop="ratingValue" class="rating">4.33</strong>
                                                    out of <span itemprop="bestRating">5</span>             based on
                                                    <span itemprop="ratingCount" class="rating">3</span>
                                                    customer ratings
                                                </span>
                                            </div> -->

                                            <a href="#reviews" class="woocommerce-review-link">(<span itemprop="reviewCount" class="count">{{count($product->reviews)}}</span> {{__('customer reviews')}} )</a>
                                        </div><!-- .woocommerce-product-rating -->

                                        

                                        <div class="availability in-stock">{{__('Availablity')}} : 
                                            @if($product->stock > 0)
                                            <span>{{__('In stock')}}</span>
                                            @else
                                            <span style="color: red">{{__('Out of stock')}}</span>

                                            @endif

                                        </div><!-- .availability -->

                                        <hr class="single-product-title-divider" />

                                        <div class="action-buttons">

                                          <span class="wishlist-loader">
                                                                <span class="loader_cart" style="display: none">
                                                                    <i class="fa fa-spinner fa-spin"></i>
                                                                </span>
                                                                <span class="real-wishlist-icon">
                                                                 <a href="javascript:void(0)" data-url="{{route('wishlist.add',$product->slug)}}" rel="nofollow" class="add_to_wishlist add2wishlist">{{__('Wishlist')}}</a>
                                                                </span>
                                                            </span>
                                                            <span class="compare-loader">
                                                                <span class="loader_cart" style="display: none">
                                                                    <i class="fa fa-spinner fa-spin"></i>
                                                                </span>
                                                                <span class="real-compare-icon">
                                                                <a href="javascript:void(0)"  data-url="{{route('compare.add',$product->slug)}}"  class="add-to-compare-link compare_AI"> {{__('Compare')}}</a>

                                                                </span>
                                                            </span>
                                        </div><!-- .action-buttons -->

                                        <div itemprop="description">
                                            <!-- <ul>
                                                <li>4.5 inch HD Touch Screen (1280 x 720)</li>
                                                <li>Android 4.4 KitKat OS</li>
                                                <li>1.4 GHz Quad Core™ Processor</li>
                                                <li>20 MP front and 28 megapixel CMOS rear camera</li>
                                            </ul> -->

                                            <p>{{__($product->short_description)}}</p>
                                            <p><strong>SKU</strong>: {{$product->sku}}</p>
                                        </div><!-- .description -->

                                        <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">

                                            <p class="price"><span class="electro-price"><ins><span data-price='{{$product->price}}' class="amount priceAmount">Sr.&nbsp;{{number_format($product->price,2)}}</span></ins> </span> <input type="hidden" value="{{$product->price}}" id="PriceUpdate" id="priceProduct" name=""><del><span class="amount">                                                
                                                @if(!empty($product->old_price))
                                                    Sr. {{$product->old_price}}
                                                @endif
                                            </span></del></p>

                                            <meta itemprop="price" content="1215" />
                                            <meta itemprop="priceCurrency" content="USD" />
                                            <link itemprop="availability" href="http://schema.org/InStock" />

                                        </div><!-- /itemprop -->

                                        <form class="variations_form cart" id="variations_form" method="post">
                                             <div class="row">

                                                    @if($product->sizes()->count() > 0)
                                                            <label>{{__('Sizes')}}</label>
                                                            <br>
                                                            <div class="col-lg-12">
                                                                <div class="row">
                                                                    <a href="javascript:void(0)" style="color:black;margin-bottom: 20px" class="atag-size-section-real">
                                                                    <div class="col-lg-1 colorSectionMargin" title="Clear Size Filter" data-url='{{route("product.default.update",$product->id)}}' style="color: red;max-width: 20px!important;">
                                                                       <svg width="1.5em" height="2em" viewBox="0 0 16 16" class="bi bi-arrow-clockwise" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                      <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                                                                      <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                                                                    </svg>
                                                                    </div>
                                                                    </a>
                                                                    @foreach($product->sizes as $row)
                                                                    @if($row->quantity > 0)
                                                                    <a href="javascript:void(0)" style="color:black" class="atag-size-section">
                                                                    <div class="col-lg-1 colorSectionMargin sizeBorderOne" data-url='{{route("product.update.size",[$row->id,$product->id])}}' data-size-qty='{{$row->title}}' style="font-size:1rem;text-transform: uppercase;padding: 5px 10px;">
                                                                        {{__($row->title)}}
                                                                    </div>
                                                                    </a>
                                                                    @else
                                                                    <div class="col-lg-1 colorSectionMargin sizeBorderOne">
                                                                        <span  style="opacity: 0.3" >
                                                                            
                                                                        {{__($row->title)}}
                                                                        </span>
                                                                        <span style="position: absolute;left: 7px;font-size: 0.9rem;top:-3px;color: red">
                                                                             <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                              <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                                            </svg>
                                                                        </span>
                                                                    </div>
                                                                    @endif
                                                                    @endforeach

                                                                    <input type="hidden" id="sizeSelect" value="" name="">
                                                                </div>
                                                                    <div style="color: red" id="size_select_alert_msg"></div>
                                                            </div>
                                                        @endif

                                                        </div>
                                                        <div class="row">
                                                    @if($product->colors()->count() >0)

                                                            <label>{{__('Colors')}}</label>
                                                            <br>
                                                                    
                                                            <div class="col-lg-6">
                                                                <div class="row">
                                                                    <a href="javascript:void(0)" style="color:black;margin-bottom: 20px" class="atag-color-section-real">
                                                                    <div class="col-lg-1 colorSectionMargin" title="Clear Size Filter" data-slug='{{$product->price}}' style="color: red;max-width: 20px!important;">
                                                                        <svg width="1.5em" height="2em" viewBox="0 0 16 16" class="bi bi-arrow-clockwise" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                      <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                                                                      <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                                                                    </svg>
                                                                    </div>
                                                                    </a>
                                                                    @foreach($product->colors as $row)
                                                                    <a href="javascript:void(0)" class="atag-color-section">
                                                                    <div class="col-lg-1 colorSectionMargin " data-color='{{$row->code}}' style="background-color: {{$row->code}};padding:10px 10px ;">
                                                                    </div>
                                                                    </a>
                                                                    @endforeach
                                                                    <input type="hidden" value="
                                                                    @if($product->colors()->count() > 0)
                                                                        {{$product->colors()->first()->code}}
                                                                    @endif
                                                                    " id="colorCode" name="">

                                                                </div>
                                                            </div>

                                                        @endif
                                                        </div>
                                                        @if (!empty($product->attributes))
                                                            @php
                                                              $attrArr = json_decode($product->attributes, true);
                                                            @endphp
                                                          @endif
                                                          @if (!empty($attrArr))
                                                            <?php 
                                                            print_r($attrArr);
                                                            ?>
                                                            <div class="product-attributes my-4">
                                                              <div class="row">
                                                              @foreach ($attrArr as $attrKey => $attrVal)

                                                              <div class="col-lg-6">
                                                                  <div class="form-group mb-2">
                                                                    <strong for="" class="text-capitalize">{{ str_replace("_", " ", $attrKey) }} :</strong>
                                                                    <div class="">
                                                                    @foreach ($attrVal['values'] as $optionKey => $optionVal)
                                                                      <div class="custom-control custom-radio">
                                                                        <input type="hidden" class="keys" value="">
                                                                        <input type="hidden" class="values" value="">
                                                                        <label class="custom-control-label" for="{{$attrKey}}{{ $optionKey }}">

                                                                        <input type="radio" id="{{$attrKey}}{{ $optionKey }}" data-option='{{ $optionVal }}' data-name="{{$attrKey}}" name="{{ $attrKey }}" class="attrOption custom-control-input product-attr"  data-key="{{ $attrKey }}"  value="{{ $optionVal }}" {{ $loop->first ? 'checked' : '' }}>
                                                                            {{ $optionVal }}
                                                                        </label>
                                                                      </div>
                                                                    @endforeach
                                                                    </div>
                                                                  </div>
                                                              </div>
                                                              @endforeach
                                                              </div>
                                                            </div>
                                                          @endif
                                                       


                                            <div class="single_variation_wrap">
                                                <div class="woocommerce-variation single_variation"></div>
                                                <div class="woocommerce-variation-add-to-cart variations_button">
                                                    @if($product->wholesale->count() > 0)
                                                    <div style="width: 15rem" class="quantity">
                                                        <select  id="selectWS" class="input-text qty text" >
                                                            <option value=" " selected="selected"> Buy In WholeSale</option>
                                                            @foreach($product->wholesale as $ws)
                                                            <option class="childSelect" data-url='{{route("wholesale.price.update",$ws->id)}}' value="{{$ws->id}}">{{$ws->qty}} - {{ $ws->unit}} - Sr. {{ number_format($ws->price,2)}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @endif
                                                    <div  class="quantity">
                                                        <label>{{__('Quantity')}} :</label>
                                                        <input type="number" id="qtyCount" name="quantity" value="1" title="Qty" class="input-text qty text"/>
                                                    </div>
                                        </form>
                                            @if($product->stock > 0)
                                                    <a href="javascript:void(0)" data-url='{{url("/cart/add_product",$product->slug)}}' id="addCart" class="single_add_to_cart_button button">{{__('Add to cart')}}</a>
                                            @else
                                                    <a class="single_add_to_cart_button button">{{__('Out Of Stock')}}</a>
                                            @endif        
                                                </div>
                                            </div>


                                    </div><!-- .summary -->
                                </div><!-- /.single-product-wrapper -->
                                <div style="border:1px solid #ddd;border-radius: 1rem;padding: 3rem" >
                                    <p class="lead" style="text-align: center"><span style="color: #f21616;font-weight: 500">Sold By :</span><b>
                                        @if($product->shop_id != null)
                                        {{$product->shop->shop_name}}
                                        @else
                                        {{env('APP_NAME')}}

                                        @endif
                                    </b>
                                        @if($product->shop_id != null)
                                    <div class="lead" style="color: #f21616;text-align: center;font-weight: 500">Total Items : <b style="color: #000">
                                        {{$product->shop->products->count()}}</b></div>
                                    <div style="text-align: center;margin-top: 30px"><a href="#" class="button alt">Visit Store</a></div>
                                        @endif
                                    </p>
                                </div>
                                <div class="divider" style="margin:5rem 0px"></div>
                                <aside id="tag_cloud-2" class="widget widget_tag_cloud"><h3 class="widget-title">{{__('Tags Clouds')}}</h3>
                                    <div class="tagcloud">
                                        @foreach($product->tags as $tag)
                                        <a href='javascript:void(0)' style='font-size: 22pt;'>{{__($tag->name)}}</a>
                                        @endforeach
                                                                
                                    </div>
                                </aside>
                                <div style="padding: 40px 0px"></div>
                                <div class="woocommerce-tabs wc-tabs-wrapper">
                                    <ul class="nav nav-tabs electro-nav-tabs tabs wc-tabs" role="tablist">

                                        <li class="nav-item description_tab">
                                            <a href="#tab-description" class="active" data-toggle="tab">{{__('Description')}}</a>
                                        </li>

                                        <li class="nav-item reviews_tab">
                                            <a href="#tab-reviews" data-toggle="tab">{{__('Reviews')}}</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content">

                                        <div class="tab-pane active in panel entry-content wc-tab" id="tab-description">
                                            <div class="electro-description">
                                                {!! __($product->description) !!}
                                            </div><!-- /.electro-description -->
                                        </div>


                                        <div class="tab-pane panel entry-content wc-tab" id="tab-reviews">
                                            <div id="reviews" class="electro-advanced-reviews">
                                                <div class="advanced-review row">
                                                    <!-- <div class="col-xs-12 col-md-6">
                                                        <h2 class="based-title">Based on 3 reviews</h2>
                                                        <div class="avg-rating">
                                                            <span class="avg-rating-number">4.3</span> overall
                                                        </div>

                                                        <div class="rating-histogram">
                                                            <div class="rating-bar">
                                                                <div class="star-rating" title="Rated 5 out of 5">
                                                                    <span style="width:100%"></span>
                                                                </div>
                                                                <div class="rating-percentage-bar">
                                                                    <span style="width:33%" class="rating-percentage">

                                                                    </span>
                                                                </div>
                                                                <div class="rating-count">1</div>
                                                            </div>
                                                             .rating-bar -->

                                                      <!--       <div class="rating-bar">
                                                                <div class="star-rating" title="Rated 4 out of 5">
                                                                    <span style="width:80%"></span>
                                                                </div>
                                                                <div class="rating-percentage-bar">
                                                                    <span style="width:67%" class="rating-percentage"></span>
                                                                </div>
                                                                <div class="rating-count">2</div>
                                                            </div>

                                                            <div class="rating-bar">
                                                                <div class="star-rating" title="Rated 3 out of 5">
                                                                    <span style="width:60%"></span>
                                                                </div>
                                                                <div class="rating-percentage-bar">
                                                                    <span style="width:0%" class="rating-percentage"></span>
                                                                </div>
                                                                <div class="rating-count zero">0</div>
                                                            </div>

                                                            <div class="rating-bar">
                                                                <div class="star-rating" title="Rated 2 out of 5">
                                                                    <span style="width:40%"></span>
                                                                </div>
                                                                <div class="rating-percentage-bar">
                                                                    <span style="width:0%" class="rating-percentage"></span>
                                                                </div>
                                                                <div class="rating-count zero">0</div>
                                                            </div>

                                                            <div class="rating-bar">
                                                                <div class="star-rating" title="Rated 1 out of 5">
                                                                    <span style="width:20%"></span>
                                                                </div>
                                                                <div class="rating-percentage-bar">
                                                                    <span style="width:0%" class="rating-percentage"></span>
                                                                </div>
                                                                <div class="rating-count zero">0</div>
                                                            </div> -->
                                                        <!-- </div>
                                                    </div> -->

                                                    <div class="col-xs-12 col-md-12">
                                                        <div id="review_form_wrapper">
                                                            <div id="review_form">
                                                                <div id="respond" class="comment-respond">
                                                                    <h3 id="reply-title" class="comment-reply-title">{{__('Add a review')}}
                                                                        <small><a rel="nofollow" id="cancel-comment-reply-link" href="#" style="display:none;">{{__('Cancel reply')}}</a>
                                                                        </small>
                                                                    </h3>
                                                                        @if(Auth::check())
                                                                        <div class="alert alert-danger" style="display: none" id="msg"></div>

                                                                    <form action="javascript:void(0)" method="post" id="commentform" class="comment-form">
                                                                        @csrf
                                                                        <!-- <p class="comment-form-rating">
                                                                            <label>Your Rating</label>
                                                                        </p>

                                                                        <p class="stars">
                                                                            <span><a class="star-1" href="#">1</a>
                                                                                <a class="star-2" href="#">2</a>
                                                                                <a class="star-3" href="#">3</a>
                                                                                <a class="star-4" href="#">4</a>
                                                                                <a class="star-5" href="#">5</a>
                                                                            </span>
                                                                        </p> -->
                                                                        <p class="comment-form-comment">
                                                                            <textarea id="comment" name="reviewForm" cols="45" rows="8" aria-required="true"></textarea>
                                                                        </p>
                                                                        <p class="form-row" style="text-align: right;">
                                                                            <button class="button alt">{{__('Add Review')}}</button>
                                                                        </p>

                                                                    </form><!-- form -->
                                                                    @else
                                                                    <a href="{{url('/login')}}" class="btn btn-primary">{{__('Login to add review !')}}</a>
                                                                    @endif
                                                                </div><!-- #respond -->
                                                            </div>
                                                        </div>

                                                    </div><!-- /.col -->
                                                </div><!-- /.row -->

                                                <div id="comments">

                                                    <ol class="commentlist">
                                                        @include('front.ajax.review')
                                                    </ol><!-- /.commentlist -->

                                                </div><!-- /#comments -->

                                                <div class="clear"></div>
                                            </div><!-- /.electro-advanced-reviews -->
                                       </div><!-- /.panel -->
                                    </div>
                                </div><!-- /.woocommerce-tabs -->

                                <div class="related products">
                                    <h2>Related Products</h2>

                                    <ul class="products columns-5">
                                        @foreach($related_products as $row)
                                        <li class="product"> 
                                            <div class="product-outer">
                                                <div class="product-inner">

                                                    @if($row->category)
                                                    <span class="loop-product-categories">
                                                        <a href="{{url('/shop'.'?category='.$row->category->slug)}}" rel="tag">{{__($row->category->name)}}</a>
                                                    </span>
                                                    @endif
                                                    <a href="{{url('/'.$row->slug)}}">
                                                        <h3>{{__($row->name)}}</h3>
                                                        <div class="product-thumbnail">
                                                            <img data-echo="{{asset($row->thumbnail)}}" src="{{asset($row->thumbnail)}}" alt="">
                                                        </div>
                                                    </a>

                                                    <div class="price-add-to-cart">
                                                        <span class="price">
                                                            <span class="electro-price">
                                                                <ins><span class="amount">Sr. {{number_format($row->price,2)}}</span></ins>
                                                                @if($row->old_price)
                                                                    <del><span class="amount">
                                                                       Sr. {{number_format($row->old_price,2)}}
                                                                     </span></del>
                                                                @endif
                                                            </span>
                                                        </span>
                                                        <div class="cart-loader">
                                                        <span class="loader_cart" style="display: none">
                                                            <i class="fa fa-spinner fa-spin"></i>
                                                        </span>
                                                        <span class="real-cart-icon">
                                                            
                                                    <a rel="nofollow" href="javascript:void(0)" data-url="{{url('/cart/add',$row->slug)}}" class="button add_to_cart_button add2cart">{{__('Add to cart')}}</a>
                                                        </span>
                                                    </div>
                                                    </div><!-- /.price-add-to-cart -->

                                                    <div class="hover-area">
                                                        <div class="action-buttons">
                                                            <span class="wishlist-loader">
                                                                <span class="loader_cart" style="display: none">
                                                                    <i class="fa fa-spinner fa-spin"></i>
                                                                </span>
                                                                <span class="real-wishlist-icon">
                                                                 <a href="javascript:void(0)" data-url="{{route('wishlist.add',$row->slug)}}" rel="nofollow" class="add_to_wishlist add2wishlist">{{__('Wishlist')}}</a>
                                                                </span>
                                                            </span>
                                                            <span class="compare-loader">
                                                                <span class="loader_cart" style="display: none">
                                                                    <i class="fa fa-spinner fa-spin"></i>
                                                                </span>
                                                                <span class="real-compare-icon">
                                                                <a href="javascript:void(0)"  data-url="{{route('compare.add',$row->slug)}}"  class="add-to-compare-link compare_AI"> {{__('Compare')}}</a>

                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div><!-- /.product-inner -->
                                            </div><!-- /.product-outer -->
                                        </li>
                                        @endforeach
                                   
                                    </ul><!-- /.products -->
                                </div><!-- /.related -->
                            </div><!-- /.product -->

                        </main><!-- /.site-main -->
                    </div><!-- /.content-area -->
                </div><!-- /.container -->
            </div><!-- /.site-content -->
            @include('front.includes.bottom-ads')

@endsection
@section('jquery')
 <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/toastr.css')}}">
<script type="text/javascript" src="{{ asset('assets/js/toastr.js')}}"></script>
<script type="text/javascript">
     // Color Customization
    document.getElementById("variations_form").reset(); 

     <?php
     if ($product->colors()->count() > 0) {

     ?>
        var colorSelect = jQuery('.atag-color-section').children('.colorSectionMargin');
        colorSelect.first().attr('class','col-lg-1 colorSectionMargin colorSectionSelect');
     <?php
    }
     ?>   

    function qty_check() {
        var qty_val = jQuery('#qtyCount').attr('value');
        if (qty_val < 1) {
         jQuery('#qtyCount').attr('value',1);
        }

    }
 
    jQuery('.atag-color-section').click(function ()
    {
        var child = jQuery(this).children('.colorSectionMargin');
        var childR = jQuery('.atag-color-section').children('.colorSectionMargin');
        var dataColor = child.attr('data-color');

        childR.attr('class','col-lg-1 colorSectionMargin ').not((child)).attr('class');
        child.attr('class','col-lg-1 colorSectionMargin colorSectionSelect');
        // childR.attr('class','col-lg-1 colorSectionMargin').not((child));
        // var len = jQuery('div.colorSectionSelect').length;
        // var qty = jQuery('#qtyCount').removeAttr('value');
        // var ans = jQuery('#qtyCount').attr('value',len);
        var color = jQuery('#colorCode').attr('value',dataColor);
        qty_check();

    })
     jQuery('.atag-color-section-real').click(function (){

        var child = jQuery('.atag-color-section').children('.colorSectionMargin');
        child.removeAttr('class');
        child.attr('class','col-lg-1 colorSectionMargin');

        
        var len = jQuery('div.colorSectionSelect').length;
        var qty = jQuery('#qtyCount').removeAttr('value');
        var ans = jQuery('#qtyCount').attr('value',len);
        var ans = jQuery('#qtyCount').attr('value',len);
        qty_check();

    });

     // Size Customization

         jQuery('.atag-size-section').click(function (){

            var child = jQuery('.sizeBorderTwo');
            child.removeAttr('class');
            child.attr('class','col-lg-1 colorSectionMargin sizeBorderOne');
            var child2 = jQuery(this).children('.sizeBorderOne');
            child2.removeAttr('class');
            child2.attr('class','col-lg-1 colorSectionMargin sizeBorderTwo');

        });
         jQuery('.colorSectionMargin').click(function () {

         <?php
            if($product->wholesale->count() > 0){
         ?>

            var checkCon = jQuery('#selectWS').first('option:selected').val();
            if (checkCon == ' ' ) {

        <?php
            }
        ?>

                 var url = jQuery(this).attr('data-url');
                 var crt =jQuery('.priceAmount');
                 jQuery.ajax({
                    url:url,
                    type:'POST',
                    data:{_token:jQuery('#_token').attr('content')},
                    success:function (data) {
                        if (data.price) {
                            crt.html('Sr.'+data.price);
                        }
                    },
                 });

            <?php
                if($product->wholesale->count() > 0){
             ?>
             
                 }else{
                    jQuery('#size_select_alert_msg').html('<span style="color:red">Note&nbsp;:&nbsp;WholeSale is Selected</span');
                 }

            <?php
                }
            ?>

            var sizTitle = jQuery(this).attr('data-size-qty');
             jQuery('#sizeSelect').val(sizTitle);
         });
         // jQuery(document).on('click','')
         // function setSize(size) {
         //    jQuery('#sizeSelect').val(size);
         // }
     
     jQuery('#selectWS').change(function () {
         var crt = jQuery(this).children('option:selected');
         var price =jQuery('.priceAmount');
         var url =crt.attr('data-url');
         jQuery.ajax({
            url:url,
            type:'POST',
            data:{_token:jQuery('#_token').attr('content')},
            success:function (data) {
                if (data.price) {
                    price.html('Sr.'+data.price);
                    jQuery('#qtyCount').val(data.qty);
                }
            },
         });
     });
     function reviewsFetch() {
        jQuery.ajax( {
           url: '<?=url("/review_view")?>',
           method:'POST',
           data: { 
            _token:jQuery('#_token').attr('content'),
            slug:"{{$product->slug}}"
            },
           success:function (data) {
               jQuery('.commentlist').empty();
               jQuery('.commentlist').html(data.html);
           }
        });
    }
     jQuery('#commentform').submit(function (e) {
         e.preventDefault();
          var url ="{{url('/reviewStore',$product->slug)}}";
          var review =jQuery('#comment').val();
         jQuery.ajax({
            url:url,
            type:'POST',
            data:{
                _token:jQuery('#_token').attr('content'),
                reviewForm:review,
            },
            success:function (data) {
            if (data.success) {
                toastr.success(data.success,'{{__("Success")}}'); 
                jQuery('#comment').val('');
                reviewsFetch();
            }
            if (data.danger) {
                toastr.error(data.danger,'{{__("Danger")}}');
                jQuery('#msg').html(data.error);
                jQuery('#msg').show(400);
            }
            },
         });
     });

     
    // AJAX ADD2CART


    jQuery('#addCart').click(function () {
        var prdAttr = "";
        jQuery('.attrOption:checked').each(function () {
          var opt = jQuery(this).attr('data-option');
          var name =  jQuery(this).attr('data-name');
          prdAttr += name+':'+opt+',';          
        });


            jQuery.ajax({
                url:jQuery(this).attr('data-url'),
                type:'post',
                data:{
                    _token:jQuery('#_token').attr('content'),
                    qty:jQuery('#qtyCount').val(),
                    price:jQuery('#PriceUpdate').val(),
                    color:jQuery('#colorCode').val(),
                    size:jQuery('#sizeSelect').val(),
                    attrs:prdAttr,
                },
                success:function(data){
                    upperCart();
                    toastr.success(data.success, 'Success');
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
</script>
@endsection