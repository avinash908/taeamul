 <div class="cart_totals ">

    <h2>{{__('Cart Totals')}}</h2>

    <table class="shop_table shop_table_responsive">

        <tbody>
            <tr class="cart-subtotal">
                <th>{{__('Subtotal')}}</th>
                <td data-title="Subtotal"><span class="amount">Sr. {{Cart::subtotal()}}</span></td>
            </tr>
            @if(Session::has('couponTotal'))
            <tr class="cart-subtotal">
                <th>{{__('Coupon Discount')}}</th>
                <td data-title="Subtotal"><span class="amount">Sr. {{number_format(Session::get('couponTotal'),2)}}</span></td>
            </tr>
            @endif
            <tr class="order-total">
                <th>{{__('Total')}}</th>
                <td data-title="Total" id="refAG"><strong><span class="amount">Sr. 
                    <?php
                    if (Session::has('couponTotal')) {
                       $c = round(Cart::total()) - Session::get('couponTotal');
                       echo number_format($c,2);
                    }else{
                       echo Cart::total();
                    }
                    ?>
            </span></strong> </td>
            </tr>
        </tbody>
    </table>
        <a class="button alt " href="{{url('/checkout')}}">{{__('Proceed to Checkout')}}</a>

    <div class="wc-proceed-to-checkout">

    </div>
</div>