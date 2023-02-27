<li class="nav-item dropdown">
    <a href="{{url('/cart')}}" class="nav-link mr-5" data-toggle="dropdown">
        <i class="ec ec-shopping-bag"></i>
        <span id="cartCountItems" class="cart-items-count count">{{Cart::content()->count()}}</span>
    </a>
    <ul class="dropdown-menu dropdown-menu-mini-cart">
        <li>
            <div class="widget_shopping_cart_content">

                <ul class="cart_list product_list_widget ">

                    @foreach(Cart::content() as $row)
                    <li class="mini_cart_item">
                        <a title="Remove this item" id="addcart" class="removeItem remove" data-cart-remove="{{url('/cart/remove',$row->rowId)}}" href="javascript:void(0)">x</a>
                        <a href="">
                            <img class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" src="{{asset($row->options->picture)}}" alt="">{{__($row->name)}}&nbsp;
                        </a>

                        <span class="quantity">{{$row->qty}} × <span class="amount">Sr. {{number_format($row->price,2)}}</span></span>
                    </li>
                    @endforeach


                    


                </ul><!-- end product list -->


                <!-- <p class="total"><strong>Subtotal:</strong> <span class="amount"></span></p> -->


                <p class="buttons">
                    <a class="button wc-forward" href="{{url('/cart')}}">{{__('View Cart')}}</a>
                    <a class="button checkout wc-forward" href="{{url('/checkout')}}">{{__('Checkout')}}</a>
                </p>


            </div>
        </li>
    </ul>
</li>
