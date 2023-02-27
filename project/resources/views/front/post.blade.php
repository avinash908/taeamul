@extends('layouts.front.master')
@include('front.includes.seo')
@section('body-classes','single-post right-sidebar')

@section('content')
<style type="text/css">
    html{
        scroll-behavior: smooth;
    }
</style>
 <div id="content" class="site-content" tabindex="-1">
                <div class="container">
                     @if ($errors->any())
        <hr/>
            <ul class="alert alert-danger list-unstyled">
                @foreach($errors->all() as $error)
                    <li>{{ __($error) }}</li>
                @endforeach
            </ul>
        @endif

                    <nav itemprop="breadcrumb" class="woocommerce-breadcrumb"><a href="home.html">{{__('Home')}}</a><span class="delimiter"><i class="fa fa-angle-right"></i></span><a href="#">{{__($post->category->title)}}</a><span class="delimiter"><i class="fa fa-angle-right"></i></span>{{__($post->title)}}</nav>

                    <div id="primary" class="content-area">
                        <main id="main" class="site-main">
                            <article class="post type-post status-publish format-gallery has-post-thumbnail hentry" >
                                <div class="media-attachment">
                                    <div class="media-attachment-gallery">
                                        <div class=" ">
                                            <div class="item">
                                                <figure>
                                                    <img width="1144" height="600" src="{{url('/').'/'.$post->thumbnail}}" class="attachment-post-thumbnail size-post-thumbnail"  />
                                                </figure>
                                            </div><!-- /.item -->
                                        </div>
                                    </div><!-- /.media-attachment-gallery -->
                                </div>

                                <header class="entry-header">
                                    <h1 class="entry-title" itemprop="name headline">{{__($post->title)}}<span class="comments-link"><a href="#comments">{{__('Leave a comment')}}</a></span></h1>

                                    <div class="entry-meta">
                                        <span class="cat-links"><a href="#" rel="category tag">{{__($post->category->title)}}</a></span>
                                        <span class="posted-on"><a href="#" rel="bookmark"><time class="entry-date published">{{$post->created_at->format('M D Y')}}</time></a></span>
                                    </div>
                                </header><!-- .entry-header -->

                                <div class="entry-content" itemprop="articleBody">
                                 {!! __($post->data) !!}            
                                                     </div><!-- .entry-content -->
                            </article>
                            <div class="post-author-info">
                                <div class="media">
                                    <div class="media-left media-middle">
                                        <a href="#"><img src="assets/images/blog/avatar.jpg" alt=""></a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading"><a href="#">{{env('APP_NAME')}}</a></h4>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="comments-area" id="comments">

                                <h2 class="comments-title">{{$post->comment->count()}} {{__('Comments')}}</h2>

                                <ol class="comment-list">
                                    @include('front.ajax.comments')
                                </ol><!-- .comment-list -->

                                <div class="comment-respond" id="respond">
                                    <h3 class="comment-reply-title" id="reply-title">{{__('Leave a Reply ')}}<small><a style="display:none;" href="#" id="cancel-comment-reply-link" rel="nofollow">{{__('Cancel reply')}}</a></small></h3>
                                    <form novalidate="" class="comment-form" id="commentform" method="post" action="javascript:void(0)">
                                        @csrf
                                        <p class="comment-notes"><span id="email-notes">{{__('Your email address will not be published.')}}</span>{{__(' Required fields are marked ')}}<span class="required">*</span></p><p class="comment-form-comment">
                                            <label for="comment">{{__('Comment')}} <span class="required">*</span></label> 
                                            <textarea required="required" maxlength="65525" rows="8" cols="45" name="comment" id="comment"></textarea>
                                            </p
                                            ><p class="comment-form-author">
                                                <label for="author">{{__('Name')}} <span class="required">*</span></label> 
                                            <input type="text" required="required" aria-required="true" maxlength="245" size="30" value="" name="name" id="name">
                                        </p>
                                        <p class="comment-form-email">
                                            <label for="email">{{__('Email')}} <span class="required">*</span></label> 
                                        <input type="email" required="required" aria-required="true" aria-describedby="email-notes" maxlength="100" size="30" value="" name="email" id="email">
                                    </p>
                                        
                                        <p class="form-submit"><input type="submit" value="Post Comment" class="submit"></p>
                                    </form>
                                </div><!-- #respond -->

                            </div>
                        </main><!-- #main -->
                    </div><!-- #primary -->

                    <div id="sidebar" class="sidebar-blog" role="complementary">
                        <aside id="search-2" class="widget widget_search">
                            <form role="search" method="get" class="search-form" action="{{url('/blog')}}">
                                <label>
                                    <span class="screen-reader-text">{{__('Search for')}}:</span>
                                    <input type="search" class="search-field" placeholder="Search &hellip;" value="" name="s" />
                                </label>
                                <input type="submit" class="search-submit" value="Search" />
                            </form>
                        </aside>
                       
                        <aside class="widget widget_categories">
                            <h3 class="widget-title">{{__('Categories')}}</h3>
                            <ul>
                                @foreach($cat as $row)
                                <li class="cat-item"><a href="{{url('/blog'.'?category='.$row->slug)}}" >{{__($row->title)}}</a></li>
                                @endforeach
                            </ul>
                        </aside>
                        <aside class="widget electro_recent_posts_widget"><h3 class="widget-title">{{__('Recent Posts')}}</h3>
                            <ul>
                                @foreach($recentPosts as $rec)
                                <li>
                                    <a class="post-thumbnail" href="{{url('blog/post',$rec->slug)}}"><img width="150" height="150" src="{{url('/').'/'.$rec->thumbnail}}" class="wp-post-image" alt="postPic"/></a>
                                    <div class="post-content">
                                        <a class ="post-name" href="{{url('blog/post',$rec->slug)}}">{{__($rec->title)}}</a>
                                        <span class="post-date">{{$rec->created_at->format('M D Y')}}</span>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </aside>
                        <aside id="tag_cloud-2" class="widget widget_tag_cloud"><h3 class="widget-title">{{__('Tags Clouds')}}</h3>
                            <div class="tagcloud">
                                @foreach($post->tags as $tag)
                                <a href='#' class='' title='10 topics' style='font-size: 22pt;'>{{__($tag->name)}}</a>
                                @endforeach                                
                            </div>
                        </aside>
                    </div>
                </div><!-- .container -->
            </div><!-- #content -->


@endsection
@section('jquery')
<script type="text/javascript">
jQuery(document).ready(function () {
    function comments() {
        jQuery.ajax( {
           url: '<?=url("/comments_view")?>',
           method:'POST',
           data: { 
            _token:jQuery('#_token').attr('content'),
            post:"{{$post->id}}"
            },
           success:function (data) {
               jQuery('.comment-list').empty();
               jQuery('.comment-list').html(data.html);
           }
        });
    }
    jQuery('#commentform').submit(function (e) {
        e.preventDefault();
        var url = "{{route('post.comment',$post->slug)}}";
        var name = jQuery('#name').val();
        var email = jQuery('#email').val();
        var comment = jQuery('#comment').val();
        jQuery.ajax({
            url:url,
            type:'POST',
            data:{
                _token:jQuery('#_token').attr('content')    ,
                name:name,
                email:email,
                comment:comment,
            },
            success:function (data) {
                comments();
                if (data.success) {
                    toastr.success(data.success, '{{__("Success")}}');
                    jQuery('#commentform')[0].reset();
                }
                if (data.danger) {
                    toastr.error(data.danger, '{{__("Danger")}}');
                }

            },
        });
    });
     
});
    

</script>
@endsection