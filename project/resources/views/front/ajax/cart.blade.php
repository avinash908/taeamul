 @foreach(Cart::content() as $item)
<tr class="cart_item">

    <td class="product-remove">
         <a title="Remove this item" id="addcart" class="removeItem remove" data-cart-remove="{{url('/cart/remove',$item->rowId)}}" href="javascript:void(0)">x</a>
    </td>

    <td class="product-thumbnail">
        <a href="{{url('/',App\Product::where('id',$item->id)->first()->slug)}}"><img width="180" height="180" src="{{asset($item->options->picture)}}" alt=""></a>
    </td>

    <td data-title="Product" class="product-name">
        <a href="{{url('/',App\Product::where('id',$item->id)->first()->slug)}}">{{__($item->name)}}</a>
    </td>

    <td data-title="Price" class="product-price">
        <span class="amount">{{number_format($item->price,2)}}</span>
    </td>

    <td data-title="Quantity" class="product-quantity">
        <input type="hidden" value="{{$item->rowId}}" name="rowId[]">
        <div class="quantity buttons_added">
                <label>{{__('Quantity')}} :</label>
            <input type="number" name="qty[]" value="{{$item->qty}}" title="Qty" class="input-text qty text">

        </div>
    </td>
    <td data-title="Color" class="product-subtotal">
        <span class="amount" style="display: flex;">
            <ul class="list-unstyled">
            @if($item->options->color)
            <li style="display: flex;">
               <span style="font-weight: bold">{{__('Color')}} &nbsp;</span>
            <a href="javascript:void(0)" class="atag-color-section">
            <div style="background-color: <?=$item->options->color?>;padding:10px 10px ;">
            </div>
            </a>
            </li>
            @endif
            @if($item->options->size)

            <li>
                
             <a href="javascript:void(0)" class="atag-color-section">
            <div>
               <span style="font-weight: bold">{{__('Size')}} &nbsp;:&nbsp;</span>{{$item->options->size}}
            </div>
            </a>
            </li>
            @endif
            @if($item->options->attrs)

            <li>
                
            <div>
                @foreach($item->options->attrs as $attr)
               <span style="font-weight: bold">{{__(ucwords($attr))}} </span>
               @endforeach
            </div>
            </li>
            @endif

            </ul>
        </span>
    </td>
    <td data-title="Total" class="product-subtotal">
        <span class="amount">{{number_format($item->total,2)}}</span>
    </td>
</tr>
@endforeach
<tr>
    <td class="actions" colspan="6">
            
       
             <input type="submit" value="Update Cart" name="update_cart" class="button">

        <div class="wc-proceed-to-checkout">

            <a class="checkout-button button alt wc-forward" href="{{url('/checkout')}}">{{__('Proceed to Checkout')}}</a>
        </div>
    </td>
</tr>

                                    