 <section class="brands-carousel">
    <h2 class="sr-only">{{__('Services')}}</h2>
    <div class="container">
        <div id="owl-brands" class="owl-brands owl-carousel unicase-owl-carousel owl-outer-nav">

        @foreach(App\Banner::where('position','=','bottom')->latest()->take(12)->get() as $bottom)
            <div class="item">

                <a href="{{$bottom->link}}">

                    <figure>
                        <figcaption class="text-overlay">
                            <div class="info">
                                <h4 style="color: red;">{{__($bottom->title)}}</h4>
                            </div><!-- /.info -->
                        </figcaption>

                         <img src="{{asset($bottom->image)}}" data-echo="{{asset($bottom->image)}}" style="opacity: 1;" class="img-responsive" alt="{{__($bottom->title)}}">

                    </figure>
                </a>
            </div><!-- /.item -->

        @endforeach

        </div><!-- /.owl-carousel -->

    </div>
</section>