@foreach(Cart::instance('wishlist')->content() as $row)
<tr>
    <td class="product-remove">
        <div>
            <a title="Remove this item" id="addcart" class="removeItem remove" data-cart-remove="{{url('/wishlist/remove',$row->rowId)}}" href="javascript:void(0)">x</a>
        </div>
    </td>

    <td class="product-thumbnail">
        <a href="{{url('/',$row->options->slug)}}">
            <img width="180" height="180" class="wp-post-image" src="{{asset($row->options->picture)}}"></a>
    </td>

    <td class="product-name">
        <a href="{{url('/',$row->options->slug)}}">{{__($row->name)}}</a>
    </td>

    <td class="product-price">
        <span class="electro-price"><span class="amount">{{number_format($row->price,2)}}</span></span>
    </td>

    <td class="product-stock-status">
            <span class="in-stock">
        @php
        $stock = App\Product::where('id',$row->id)->get();
        @endphp

        @if($stock[0]->stock > 0)
            {{__("In stock")}}
        @else
        <span style="color:red">{{__('Out Of stock')}}</span>

        @endif

        </span>
    </td>

    <td class="product-add-to-cart">
        
        <div class="cart-loader">
        <span class="loader_cart" style="display: none">
        <img src="{{asset('assets/images/ajax-loader.gif')}}">
    </span>
    <span class="real-cart-icon">
        
             <?php
        if($stock[0]->stock > 0){
            ?>

        <a rel="nofollow" href="javascript:void(0)" data-url="{{url('/cart/add',$row->options->slug)}}" class="button add_to_cart_button add2cart">
        {{__('Add to cart')}}

    </a>
    <?php
        }else{

            ?>
            <small style="color:red;">{{__('Cannot Add To Cart')}} <br>{{__('Because Product Is out of Stock')}}</small>
            <?php

        }
        ?>
    </span>
    </div>
        
        

        
    </td>
</tr>
@endforeach