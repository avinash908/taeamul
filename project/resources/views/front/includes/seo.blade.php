@if(isset($seo))
    @if($seo->title)
        @section('title',){{$seo->title}}@endsection
    @else
         @if(isset($title))
            @section('title'){{$title}}@endsection
        @endif
    @endif
        @if(isset($seo->meta_tags) && is_array($seo->meta_tags) && count($seo->meta_tags) > 0)
            @php $tags = '' @endphp
            @foreach($seo->meta_tags as $tag)
                 @php $tags .= $tag; @endphp
            @endforeach
            @section('seo_meta_tags'){{$tags}}@endsection
        @endif
    @section('seo_meta_description'){{$seo->meta_description}}@endsection
@else
    @if(isset($title))
        @section('title'){{$title}}@endsection
    @endif
@endif