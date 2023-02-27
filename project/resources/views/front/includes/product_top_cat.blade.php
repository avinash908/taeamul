<span class="loop-product-categories">
@if($row->childcategory)
    <a href="{{route('front.shop',[$row->childcategory->subcategory->category->slug,$row->childcategory->subcategory->slug,$row->childcategory->slug])}}" rel="tag">{{__($row->childcategory->name)}}</a>
@else
	@if($row->subcategory)
    	<a href="{{route('front.shop',[$row->subcategory->category->slug,$row->subcategory->slug])}}" rel="tag">{{__($row->subcategory->name)}}</a>
    @else
	    @if($row->category)
	    	<a href="{{route('front.shop',$row->category->slug)}}" rel="tag">{{__($row->category->name)}}</a>
	    @endif
    @endif
@endif
</span>