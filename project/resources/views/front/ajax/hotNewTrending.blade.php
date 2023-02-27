<div class="row">
    <div class="col-lg-4 col-md-4 col-xs-12">
        <aside class="widget clearfix">
            <div class="body">
                <h4 class="widget-title">Hot Products</h4>
                <ul class="product_list_widget">
                	@foreach($hot as $ht)
                    <li>
                        <a href="{{url('/',$ht->slug)}}" title="{{__(ucwords($ht->name))}}">
                            <img class="wp-post-image" data-echo="{{asset($ht->thumbnail)}}" src="{{asset($ht->thumbnail)}}" alt="">
                            <span class="product-title">{{__($ht->name)}}</span>
                        </a>
                        <span class="electro-price"><span class="amount">Sr. {{number_format($ht->price,2)}}</span></span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </aside>
    </div>
    <div class="col-lg-4 col-md-4 col-xs-12">
        <aside class="widget clearfix">
            <div class="body"><h4 class="widget-title">Sale Products</h4>
                <ul class="product_list_widget">
                	@foreach($sale as $sl)
                    <li>
                        <a href="{{url('/',$sl->slug)}}" title="{{__(ucwords($sl->name))}}">
                            <img class="wp-post-image" data-echo="{{asset($sl->thumbnail)}}" src="{{asset($sl->thumbnail)}}" alt="">
                            <span class="product-title">{{__($sl->name)}}</span>
                        </a>
                        <span class="electro-price"><ins><span class="amount">Sr. {{number_format($sl->price,2)}}</span></ins>
                        @if($sl->old_price)
                                <del><span class="amount">
                                    {{$sl->old_price}}
                                 </span></del>
                            @endif
                       </span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </aside>
    </div>
    <div class="col-lg-4 col-md-4 col-xs-12">
        <aside class="widget clearfix">
            <div class="body">
                <h4 class="widget-title">Trending Products</h4>
                <ul class="product_list_widget">
                	@foreach($trending as $trd)
                    <li>

                        <a href="{{url('/',$trd->slug)}}" title="{{__(ucwords($trd->name))}}">
                            <img class="wp-post-image" data-echo="{{asset($trd->thumbnail)}}" src="{{asset($trd->thumbnail)}}" alt="">
                            <span class="product-title">{{__($trd->name)}}</span>
                        </a>
                         <span class="electro-price"><ins><span class="amount">Sr. {{number_format($trd->price,2)}}</span></ins> 
                         @if($trd->old_price)
                                <del><span class="amount">
                                    {{$trd->old_price}}
                                 </span></del>
                            @endif
                        </span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </aside>
    </div>
</div>