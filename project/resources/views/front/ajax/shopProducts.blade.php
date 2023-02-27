
<div role="tabpanel" class="tab-pane active" id="grid" aria-expanded="true">

    <ul class="products columns-3">
      @foreach($products as $row)
       
        <li class="product ">
            <div class="product-outer">
                <div class="product-inner">
                    @include('front.includes.product_top_cat')
                    <a href="{{url('/'.$row->slug)}}">
                        <h3>{{__(ucwords($row->name))}}</h3>
                        <div class="product-thumbnail">

                            <img data-echo="{{asset($row->thumbnail)}}" src="{{asset($row->thumbnail)}}" alt="">

                        </div>
                    </a>

                    <div class="price-add-to-cart">
                       <span class="price">
                        <span class="electro-price">
                            <ins><span class="amount"> </span></ins>
                            <span class="amount"> Sr. {{number_format($row->price,2)}}</span>
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
                            <a rel="nofollow" href="javascript:void(0)" data-url="{{url('/cart/add',$row->slug)}}" class="button add_to_cart_button add2cart">{{__('Add to Cart')}}</a>
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
                </div>
                <!-- /.product-inner -->
            </div><!-- /.product-outer -->
        </li>
        @endforeach

    </ul>
</div>
<div role="tabpanel" class="tab-pane" id="grid-extended" aria-expanded="true">

    <ul class="products columns-3">
      @foreach($products as $row)
        
        <li class="product ">
            <div class="product-outer">
                <div class="product-inner">
                    @include('front.includes.product_top_cat')
                    <a href="{{url('/'.$row->slug)}}">
                        <h3>{{__(ucwords($row->name))}}</h3>
                        <div class="product-thumbnail">
                            <img class="wp-post-image" data-echo="{{asset($row->thumbnail)}}" src="{{asset($row->thumbnail)}}" alt="">
                        </div>

                        <div class="product-short-description">
                           <p>{{__($row->short_description)}}</p>
                        </div>

                        <div class="product-sku">SKU: {{$row->sku}}</div>
                    </a>
                    <div class="price-add-to-cart">
                        <span class="price">
                        <span class="electro-price">
                            <ins><span class="amount"> </span></ins>
                            <span class="amount"> Sr. {{number_format($row->price,2)}}</span>
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
                            <a rel="nofollow" href="javascript:void(0)" data-url="{{url('/cart/add',$row->slug)}}" class="button add_to_cart_button add2cart">{{__('Add to Cart')}}</a>
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
    </ul>
</div>

<div role="tabpanel" class="tab-pane" id="list-view" aria-expanded="true">
    <ul class="products columns-3">
      @foreach($products as $row)

        <li class="product list-view">
            <div class="media">
                <div class="media-left">
                    <a href="{{url('/'.$row->slug)}}">
                        <img class="wp-post-image" data-echo="{{asset($row->thumbnail)}}" src="{{asset($row->thumbnail)}}" alt="">
                    </a>
                </div>
                <div class="media-body media-middle">
                    <div class="row">
                        <div class="col-xs-12">
                         @include('front.includes.product_top_cat')
                            <a href="{{url('/'.$row->slug)}}"><h3>{{__(ucwords($row->name))}}</h3>
                                <div class="product-rating">
                                  
                                </div>
                                <div class="product-short-description">
                                   <p>{{__($row->short_description)}}</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-12">

                            <div class="availability in-stock">Availablity: 
                                @if($row->stock > 0)
                                <span>{{__('In stock')}}</span>
                                @else
                                <span style="color: red">{{__('Out of stock')}}</span>

                                @endif</div>

                           <span class="price">
                        <span class="electro-price">
                            <ins><span class="amount"> </span></ins>
                            <span class="amount"> Sr. {{number_format($row->price,2)}}</span>
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
                                <a rel="nofollow" href="javascript:void(0)" data-url="{{url('/cart/add',$row->slug)}}" class="button add_to_cart_button add2cart">{{__('Add to Cart')}}</a>
                                </span>
                            </div>
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
                        </div>
                    </div>
                </div>
            </div>
        </li>
       @endforeach
    </ul>
</div>
<div role="tabpanel" class="tab-pane" id="list-view-small" aria-expanded="true">

    <ul class="products columns-3">
      @foreach($products as $row)

        <li class="product list-view list-view-small">
            <div class="media">
                <div class="media-left">
                    <a href="{{url('/'.$row->slug)}}">
                        <img class="wp-post-image" data-echo="{{asset($row->thumbnail)}}" src="{{asset($row->thumbnail)}}" alt="">
                    </a>
                </div>
                <div class="media-body media-middle">
                    <div class="row">
                        <div class="col-xs-12">
                            @include('front.includes.product_top_cat')
                            <a href="{{url('/'.$row->slug)}}"><h3>{{__(ucwords($row->name))}}</h3>
                                <div class="product-short-description">
                                   <p>{{__($row->short_description)}}</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-12">
                            <div class="price-add-to-cart">

                               <span class="price">
                        <span class="electro-price">
                            <ins><span class="amount"> </span></ins>
                            <span class="amount"> Sr. {{number_format($row->price,2)}}</span>
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
                                    <a rel="nofollow" href="javascript:void(0)" data-url="{{url('/cart/add',$row->slug)}}" class="button add_to_cart_button add2cart">{{__('Add to Cart')}}</a>
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

                        </div>
                    </div>
                </div>
            </div>
        </li>
        @endforeach

    </ul>
</div>