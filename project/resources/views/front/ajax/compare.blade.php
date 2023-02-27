@foreach(Cart::instance('compare')->content() as $rec)
<div class="col-lg-3">
    <div class="card">
        <div class="cart-img">
            <a href="{{url('/',$rec->options->slug)}}">
                <img src="{{asset($rec->options->picture)}}" style="object-fit: cover;width: 100%;height: 200px">
            </a>
        </div>
        <div class="card-body" style="padding: 20px">
            <div class="card-text">
            <a href="{{url('/',$rec->options->slug)}}">

                <h4 style="text-align: center;font-weight: bold;color: #4646f7cc">{{__($rec->name)}}</h4>
            </a>
                <hr>
                <p style="text-align: center;">{{__($rec->options->description)}}</p>
                <hr>
                <h5 style="text-align: center;">Sr. {{number_format($rec->price,2)}}</h5>
                <hr>
                <h6 style="text-align: center;">{{__($rec->options->stock)}}</h6>
                <hr>
                <h6 style="text-align: center;"><a href="javascript:void(0)" data-url='{{url("/cart/add",$rec->options->slug)}}' class="add2cart button alt">{{__('Add to Cart')}}</a></h6>
                <hr>
                <h6 style="text-align: center;"><a href="javascript:void(0)" data-url='{{url("/compare/remove",$rec->rowId)}}' title="Remove" class="remove-icon remove-compare"><i class="fa fa-times"></i></a></h6>

            </div>
        </div>
    </div>
</div>
@endforeach