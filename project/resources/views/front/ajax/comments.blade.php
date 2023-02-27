@foreach($comment as $row)
<li class="comment even thread-even depth-1">
    <div class="media">
        <div class="gravatar-wrapper media-left">
            <img class="avatar avatar-100 photo" src="assets/images/blog/avatar.jpg" alt="">
        </div>

        <div class="comment-body media-body">

            <div class="comment-content" id="div-comment-398">
                <p>{{__($row->comment)}}</p>
            </div>

            <div class="comment-meta" id="div-comment-meta-398">
                <div class="author vcard">
                    <cite class="fn media-heading">{{__($row->name)}}</cite>
                </div>

                <div class="date">
                    <a class="comment-date" href="#">{{$row->created_at->format('M D Y')}}</a>
                </div>

               
            </div>

        </div><!-- /.comment-body -->
    </div><!-- /.media -->
</li><!-- #comment-## -->
@endforeach