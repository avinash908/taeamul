@foreach($posts as $post)
<article class="post format-gallery hentry">

	<div class="media-attachment">
		<a href="{{url('blog/post',$post->slug)}}">
		<img width="430" height="245" src="{{url('/').'/'.$post->thumbnail}}" class="wp-post-image" alt="1" /></a>
	</div><!-- .media-attachment -->

	<div class="content-body">
		<header class="entry-header">
			<h1 class="entry-title" itemprop="name headline">
				<a href="{{url('blog/post',$post->slug)}}" rel="bookmark">{{__($post->title)}}</a>
			</h1>

			<div class="entry-meta">
				<span class="cat-links">
					<a href="#" rel="category tag">{{__($post->category['title'])}}</a>
				</span>

				<span class="posted-on">
					<a href="{{url('blog/post',$post->slug)}}" rel="bookmark">
						<time class="entry-date published" datetime="2016-03-04T07:34:20+00:00">{{$post->created_at->format('M D Y')}}</time>
					</a>
				</span>
			</div>
		</header><!-- .entry-header -->

		<div class="entry-content">

			<p>{{ __(str_replace('&nbsp;', ' ', Str::limit(strip_tags($post->data),100,'...'))) }}</p>

		</div><!-- .entry-content -->

		<div class="post-readmore">
			<a href="{{url('blog/post',$post->slug)}}" class="btn btn-primary">{{__('Read More')}}</a>
		</div><!-- .post-readmore -->

		<span class="comments-link">
			<a href="{{url('blog/post',$post->slug)}}">{{$post->comment->count()}}</a>
		</span><!-- .comments-link -->
	</div><!-- .content-body -->
</article><!-- #post-## -->
@endforeach