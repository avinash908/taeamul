@foreach($product->reviews()->latest()->get() as $review)
<li itemprop="review" class="comment even thread-even depth-1">

    <div id="comment-390" class="comment_container">

        <img alt='' src="assets/images/blog/avatar.jpg" class="avatar" height='60' width='60' />
        <div class="comment-text">

         <!--    <div class="star-rating" title="Rated 4 out of 5">
                <span style="width:80%"><strong itemprop="ratingValue">4</strong> out of 5</span>
            </div> -->

            <div itemprop="description" class="description">
                <p>{{__($review->review)}}
                </p>
            </div>


            <p class="meta">
                <strong itemprop="author">{{__($review->user->name)}}</strong> &ndash; <time itemprop="datePublished" datetime="2016-03-03T14:13:48+00:00">{{$review->created_at->format('M D Y')}}</time>
            </p>


        </div>
    </div>
</li><!-- #comment-## -->
@endforeach
