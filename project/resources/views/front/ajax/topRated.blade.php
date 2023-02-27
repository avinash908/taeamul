@foreach($rated as $row)
    <li class="product column">
        <div class="product-outer"  style="height: 515px">
            <div class="product-inner">
                @include('front.includes.product_top_cat')
                <a href="{{url('/',$row->slug)}}">
                    <h3>{{__($row->name)}}</h3>
                    <div class="product-thumbnail" style="min-width: 100%">
                        <img src="{{asset($row->thumbnail)}}" style="min-width: 90%;margin-left: 1rem" data-echo="{{asset($row->thumbnail)}}" class="img-responsive" alt="">
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

                       
                        </span>
                    </div>
                </div>
            </div><!-- /.product-inner -->
        </div><!-- /.product-outer -->
    </li><!-- /.products -->
@endforeach
